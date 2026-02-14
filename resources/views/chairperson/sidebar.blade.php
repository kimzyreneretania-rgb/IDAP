<!-- Chairperson Sidebar -->
<aside class="w-64 text-white h-screen fixed left-0 top-0 overflow-y-auto" style="background: linear-gradient(135deg, #ff8c42 0%, #ffd166 50%, #ff6b35 100%);">
    <div class="p-4 h-full flex flex-col" style="background-color: rgba(0, 0, 0, 0.3);">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-white">CEIT</h1>
            <p class="text-sm text-white">Individual Development and Action Plan System</p>
        </div>
        
        <nav class="space-y-2">
            <a href="{{ route('chairperson.dashboard') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-colors {{ request()->routeIs('chairperson.dashboard') ? 'bg-white bg-opacity-20' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
            </a>
            
            <a href="{{ route('chairperson.faculty-members') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-colors {{ request()->routeIs('chairperson.faculty-members') ? 'bg-white bg-opacity-20' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Faculty Members
            </a>
            
            <div class="pt-4 mt-4 border-t border-white border-opacity-30">
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 rounded-lg hover:bg-red-600 hover:bg-opacity-80 transition-colors w-full text-left">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </nav>
    </div>
</aside>
