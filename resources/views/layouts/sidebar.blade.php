<aside class="w-64 bg-blue-700 text-white flex flex-col" x-data="{ rkiaOpen: false }">
    <!-- Logo/Brand -->
    <div class="p-6 border-b border-blue-800">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('storage/logo-kig.png') }}" alt="Logo KIG" class="w-10 h-10 object-contain">
            <div>
                <h1 class="font-bold text-lg">Sistem Audit</h1>
                <p class="text-xs text-blue-200">PT KIG</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 overflow-y-auto py-4">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('dashboard') ? 'bg-blue-800 border-l-4 border-white' : 'hover:bg-blue-600' }}">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
            </svg>
            <span>Dashboard</span>
        </a>

        <!-- RKIA Dropdown -->
        <div>
            <button @click="rkiaOpen = !rkiaOpen" class="w-full flex items-center justify-between px-6 py-3 hover:bg-blue-600">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                    </svg>
                    <span>RKIA</span>
                </div>
                <svg class="w-4 h-4 transition-transform" :class="rkiaOpen ? 'rotate-180' : ''" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
            <div x-show="rkiaOpen" x-transition class="bg-blue-800">
                <a href="{{ route('rkia.timeline') }}" class="flex items-center px-6 py-2 pl-14 hover:bg-blue-700 text-sm {{ request()->routeIs('rkia.timeline') ? 'bg-blue-700' : '' }}">
                    <span>Timeline</span>
                </a>
                <a href="{{ route('rkia.program') }}" class="flex items-center px-6 py-2 pl-14 hover:bg-blue-700 text-sm {{ request()->routeIs('rkia.program') ? 'bg-blue-700' : '' }}">
                    <span>Program</span>
                </a>
            </div>
        </div>

        <!-- Laporan -->
        <a href="{{ route('laporan.index') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('laporan.*') ? 'bg-blue-800 border-l-4 border-white' : 'hover:bg-blue-600' }}">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
            </svg>
            <span>Laporan</span>
        </a>

        <!-- Manajemen Users -->
        <a href="{{ route('users.index') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('users.*') ? 'bg-blue-800 border-l-4 border-white' : 'hover:bg-blue-600' }}">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
            </svg>
            <span>Manajemen Users</span>
        </a>

        <!-- Manajemen Role -->
        <a href="{{ route('roles.index') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('roles.*') ? 'bg-blue-800 border-l-4 border-white' : 'hover:bg-blue-600' }}">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
            </svg>
            <span>Manajemen Role</span>
        </a>
    </nav>

    <!-- User Info at Bottom -->
    <div class="p-4 border-t border-blue-800">
        <div class="text-xs text-blue-200">Masuk sebagai</div>
        <div class="font-semibold truncate">{{ Auth::user()->name }}</div>
    </div>
</aside>
