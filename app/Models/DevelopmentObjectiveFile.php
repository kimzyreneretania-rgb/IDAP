<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevelopmentObjectiveFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'development_objective_id',
        'file_path',
        'file_name',
        'verification_status',
        'rejection_reason',
        'verified_at',
        'verified_by',
    ];

    /**
     * Get the development objective that owns the file.
     */
    public function developmentObjective()
    {
        return $this->belongsTo(DevelopmentObjective::class);
    }

    /**
     * Get the user who verified the file.
     */
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
