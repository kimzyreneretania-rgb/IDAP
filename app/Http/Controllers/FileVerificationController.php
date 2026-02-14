<?php

namespace App\Http\Controllers;

use App\Models\DevelopmentObjectiveFile;
use App\Models\DevelopmentObjective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileVerificationController extends Controller
{
    /**
     * Display pending files for verification.
     */
    public function index()
    {
        $chairperson = Auth::user();
        
        // Get pending files from faculty in the same department
        $pendingFiles = DevelopmentObjectiveFile::with(['developmentObjective.user', 'verifiedBy'])
            ->where('verification_status', 'pending')
            ->whereHas('developmentObjective.user', function($query) use ($chairperson) {
                $query->where('department', $chairperson->department);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('chairperson.file-verification', compact('pendingFiles'));
    }
    
    /**
     * Show file details for verification.
     */
    public function show(DevelopmentObjectiveFile $file)
    {
        $chairperson = Auth::user();
        
        // Ensure the file is from faculty in the same department
        if ($file->developmentObjective->user->department !== $chairperson->department) {
            abort(403, 'Unauthorized action.');
        }
        
        $file->load(['developmentObjective.user', 'verifiedBy']);
        
        return view('chairperson.file-details', compact('file'));
    }
    
    /**
     * Approve a file.
     */
    public function approve(Request $request, DevelopmentObjectiveFile $file)
    {
        $chairperson = Auth::user();
        
        // Ensure the file is from faculty in the same department
        if ($file->developmentObjective->user->department !== $chairperson->department) {
            abort(403, 'Unauthorized action.');
        }
        
        // Update file verification status
        $file->update([
            'verification_status' => 'approved',
            'verified_at' => now(),
            'verified_by' => $chairperson->id,
        ]);
        
        // Check if objective should be marked as completed
        $objective = $file->developmentObjective;
        $approvedFileCount = $objective->files()->where('verification_status', 'approved')->count();
        
        if ($approvedFileCount >= $objective->max_files) {
            $objective->update([
                'status' => 'completed'
            ]);
            
            return redirect()->route('chairperson.department-reports')
                ->with('success', 'File approved! Objective marked as completed.');
        }
        
        return redirect()->route('chairperson.department-reports')
            ->with('success', 'File approved successfully!');
    }
    
    /**
     * Reject a file.
     */
    public function reject(Request $request, DevelopmentObjectiveFile $file)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:255',
        ]);
        
        $chairperson = Auth::user();
        
        // Ensure the file is from faculty in the same department
        if ($file->developmentObjective->user->department !== $chairperson->department) {
            abort(403, 'Unauthorized action.');
        }
        
        // Update file verification status
        $file->update([
            'verification_status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'verified_at' => now(),
            'verified_by' => $chairperson->id,
        ]);
        
        // Check if objective status should be changed back
        $objective = $file->developmentObjective;
        $approvedFileCount = $objective->files()->where('verification_status', 'approved')->count();
        
        if ($objective->status === 'completed' && $approvedFileCount < $objective->max_files) {
            $objective->update([
                'status' => 'in_progress'
            ]);
        }
        
        return redirect()->route('chairperson.department-reports')
            ->with('success', 'File rejected successfully!');
    }
    
    /**
     * Download file for review.
     */
    public function download(DevelopmentObjectiveFile $file)
    {
        $chairperson = Auth::user();
        
        // Ensure the file is from faculty in the same department
        if ($file->developmentObjective->user->department !== $chairperson->department) {
            abort(403, 'Unauthorized action.');
        }
        
        if (Storage::disk('public')->exists($file->file_path)) {
            return Storage::disk('public')->download($file->file_path, $file->file_name);
        }
        
        return redirect()->back()->with('error', 'File not found.');
    }
}
