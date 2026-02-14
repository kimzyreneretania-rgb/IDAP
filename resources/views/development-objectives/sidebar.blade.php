<!-- Faculty Member Sidebar -->
<aside class="w-64 text-white h-screen fixed left-0 top-0 overflow-y-auto" style="background: linear-gradient(135deg, #ff8c42 0%, #ffd166 50%, #ff6b35 100%);">
    <div class="p-4 h-full flex flex-col" style="background-color: rgba(0, 0, 0, 0.3);">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-white">CEIT</h1>
            <p class="text-sm text-white">Individual Development and Action Plan System</p>
        </div>
        
        <nav class="space-y-2">
            <a href="{{ route('development-objectives.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-colors {{ request()->routeIs('development-objectives.*') ? 'bg-white bg-opacity-20' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                Development Objectives
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
