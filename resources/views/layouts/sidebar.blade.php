<aside class="w-64 text-white flex flex-col relative overflow-hidden" x-data="{ rkiaOpen: false }" style="background: linear-gradient(180deg, #1e3a8a 0%, #312e81 50%, #1e1b4b 100%);">
    <!-- Animated Background Bubbles -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="bubble bubble-1"></div>
        <div class="bubble bubble-2"></div>
        <div class="bubble bubble-3"></div>
        <div class="bubble bubble-4"></div>
        <div class="bubble bubble-5"></div>
    </div>

    <!-- Logo/Brand -->
    <div class="p-6 border-b border-white/10 relative z-10">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center p-2">
                <img src="{{ asset('storage/logo-kig.png') }}" alt="Logo KIG" class="w-full h-full object-contain">
            </div>
            <div>
                <h1 class="font-bold text-lg">Sistem Audit</h1>
                <p class="text-xs text-white/70">PT KIG</p>
            </div>
        </div>
    </div>

    <style>
        .bubble {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(10px);
            animation: float linear infinite;
        }

        .bubble-1 {
            width: 80px;
            height: 80px;
            left: 10%;
            bottom: -80px;
            animation-duration: 15s;
            animation-delay: 0s;
        }

        .bubble-2 {
            width: 60px;
            height: 60px;
            left: 60%;
            bottom: -60px;
            animation-duration: 18s;
            animation-delay: 3s;
        }

        .bubble-3 {
            width: 100px;
            height: 100px;
            left: 30%;
            bottom: -100px;
            animation-duration: 20s;
            animation-delay: 6s;
        }

        .bubble-4 {
            width: 50px;
            height: 50px;
            left: 75%;
            bottom: -50px;
            animation-duration: 16s;
            animation-delay: 2s;
        }

        .bubble-5 {
            width: 70px;
            height: 70px;
            left: 45%;
            bottom: -70px;
            animation-duration: 22s;
            animation-delay: 8s;
        }

        @keyframes float {
            0% {
                transform: translateY(0) translateX(0) scale(1);
                opacity: 0;
            }
            10% {
                opacity: 0.3;
            }
            50% {
                transform: translateY(-50vh) translateX(20px) scale(1.1);
                opacity: 0.2;
            }
            100% {
                transform: translateY(-100vh) translateX(-20px) scale(0.8);
                opacity: 0;
            }
        }
    </style>

    <!-- Navigation Menu -->
    <nav class="flex-1 overflow-y-auto py-4 relative z-10">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-white/20 backdrop-blur-sm border-l-4 border-white shadow-lg' : 'hover:bg-white/10 hover:backdrop-blur-sm' }}">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- RKIA Dropdown -->
        <div>
            <button @click="rkiaOpen = !rkiaOpen" class="w-full flex items-center justify-between px-6 py-3 transition-all duration-200 hover:bg-white/10 hover:backdrop-blur-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">RKIA</span>
                </div>
                <svg class="w-4 h-4 transition-transform duration-200" :class="rkiaOpen ? 'rotate-180' : ''" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
            <div x-show="rkiaOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 class="bg-black/20 backdrop-blur-sm">
                <a href="{{ route('rkia.timeline') }}" class="flex items-center px-6 py-2 pl-14 hover:bg-white/10 text-sm transition-all duration-200 {{ request()->routeIs('rkia.timeline*') ? 'bg-white/10 font-semibold' : '' }}">
                    <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span>Timeline</span>
                </a>
                <a href="{{ route('rkia.program') }}" class="flex items-center px-6 py-2 pl-14 hover:bg-white/10 text-sm transition-all duration-200 {{ request()->routeIs('rkia.program*') || request()->routeIs('audit-programs.*') || request()->routeIs('audit-questions.*') ? 'bg-white/10 font-semibold' : '' }}">
                    <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span>Program</span>
                </a>
            </div>
        </div>

        <!-- Laporan -->
        <a href="{{ route('laporan.index') }}" class="flex items-center px-6 py-3 transition-all duration-200 {{ request()->routeIs('laporan.*') ? 'bg-white/20 backdrop-blur-sm border-l-4 border-white shadow-lg' : 'hover:bg-white/10 hover:backdrop-blur-sm' }}">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
            </svg>
            <span class="font-medium">Laporan</span>
        </a>

        @if(Auth::user()->role->name === 'admin')
            <!-- Divider -->
            <div class="px-6 py-3 mt-2">
                <div class="border-t border-white/20"></div>
                <p class="text-xs text-white/60 mt-3 uppercase font-semibold tracking-wider">Manajemen</p>
            </div>

            <!-- Manajemen Departemen -->
            <a href="{{ route('departments.index') }}" class="flex items-center px-6 py-3 transition-all duration-200 {{ request()->routeIs('departments.*') ? 'bg-white/20 backdrop-blur-sm border-l-4 border-white shadow-lg' : 'hover:bg-white/10 hover:backdrop-blur-sm' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
                <span class="font-medium">Departemen</span>
            </a>

            <!-- Manajemen Users -->
            <a href="{{ route('users.index') }}" class="flex items-center px-6 py-3 transition-all duration-200 {{ request()->routeIs('users.*') ? 'bg-white/20 backdrop-blur-sm border-l-4 border-white shadow-lg' : 'hover:bg-white/10 hover:backdrop-blur-sm' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                </svg>
                <span class="font-medium">Users</span>
            </a>

            <!-- Manajemen Role -->
            <a href="{{ route('roles.index') }}" class="flex items-center px-6 py-3 transition-all duration-200 {{ request()->routeIs('roles.*') ? 'bg-white/20 backdrop-blur-sm border-l-4 border-white shadow-lg' : 'hover:bg-white/10 hover:backdrop-blur-sm' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                </svg>
                <span class="font-medium">Roles</span>
            </a>
        @endif
    </nav>

    <!-- User Info at Bottom -->
    <div class="p-4 border-t border-white/10 relative z-10 bg-black/20 backdrop-blur-sm">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                {{ substr(Auth::user()->name, 0, 2) }}
            </div>
            <div class="flex-1 min-w-0">
                <div class="text-xs text-white/60">Masuk sebagai</div>
                <div class="font-semibold truncate text-sm">{{ Auth::user()->name }}</div>
                <div class="text-xs text-white/50 truncate">{{ Auth::user()->role->name }}</div>
            </div>
        </div>
        
        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}" class="mt-3">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-3 py-2 bg-white/10 hover:bg-white/20 rounded-lg text-sm font-medium transition-all duration-200 backdrop-blur-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
</aside>
