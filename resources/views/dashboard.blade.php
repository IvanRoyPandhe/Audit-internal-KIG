<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    @php
        $userRole = Auth::user()->role->name;
    @endphp

    @if($userRole === 'auditor')
        <!-- AUDITOR DASHBOARD - MODERN COLORFUL STYLE -->
        <div class="space-y-6">
            
            <!-- Top Stats Cards - Colorful Gradient Style -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Card 1: Program Aktif (Warm Gradient) -->
                <div class="relative rounded-3xl shadow-xl overflow-hidden group hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-300 via-pink-400 to-pink-500"></div>
                    <!-- Large decorative circles -->
                    <div class="absolute top-0 right-0 w-48 h-48 bg-white/20 rounded-full -mr-24 -mt-24"></div>
                    <div class="absolute bottom-0 left-0 w-40 h-40 bg-white/10 rounded-full -ml-20 -mb-20"></div>
                    <div class="absolute top-1/2 right-1/4 w-24 h-24 bg-white/5 rounded-full"></div>
                    
                    <div class="relative p-8 text-white">
                        <div class="flex items-start justify-between mb-6">
                            <div>
                                <p class="text-white/90 text-sm font-medium mb-2">Program Aktif</p>
                                <h3 class="text-6xl font-bold mb-3">{{ $activePrograms }}</h3>
                                <p class="text-white/80 text-sm">
                                    @if($activePrograms > 0)
                                        Sedang berjalan
                                    @else
                                        Belum ada program
                                    @endif
                                </p>
                            </div>
                            <div class="w-14 h-14 bg-white/25 backdrop-blur-sm rounded-2xl flex items-center justify-center group-hover:rotate-12 transition-transform">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Timeline Aktif (Cool Blue Gradient) -->
                <div class="relative rounded-3xl shadow-xl overflow-hidden group hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400 via-blue-500 to-cyan-400"></div>
                    <!-- Large decorative circles -->
                    <div class="absolute top-0 right-0 w-48 h-48 bg-white/20 rounded-full -mr-24 -mt-24"></div>
                    <div class="absolute bottom-0 left-0 w-40 h-40 bg-white/10 rounded-full -ml-20 -mb-20"></div>
                    <div class="absolute top-1/2 right-1/4 w-24 h-24 bg-white/5 rounded-full"></div>
                    
                    <div class="relative p-8 text-white">
                        <div class="flex items-start justify-between mb-6">
                            <div>
                                <p class="text-white/90 text-sm font-medium mb-2">Timeline Aktif</p>
                                <h3 class="text-6xl font-bold mb-3">{{ $activeTimelines }}</h3>
                                <p class="text-white/80 text-sm">
                                    @if($activeTimelines > 0)
                                        Tahun {{ date('Y') }}
                                    @else
                                        Belum ada timeline
                                    @endif
                                </p>
                            </div>
                            <div class="w-14 h-14 bg-white/25 backdrop-blur-sm rounded-2xl flex items-center justify-center group-hover:rotate-12 transition-transform">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Audit Selesai (Fresh Green Gradient) -->
                <div class="relative rounded-3xl shadow-xl overflow-hidden group hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-300 via-green-400 to-teal-400"></div>
                    <!-- Large decorative circles -->
                    <div class="absolute top-0 right-0 w-48 h-48 bg-white/20 rounded-full -mr-24 -mt-24"></div>
                    <div class="absolute bottom-0 left-0 w-40 h-40 bg-white/10 rounded-full -ml-20 -mb-20"></div>
                    <div class="absolute top-1/2 right-1/4 w-24 h-24 bg-white/5 rounded-full"></div>
                    
                    <div class="relative p-8 text-white">
                        <div class="flex items-start justify-between mb-6">
                            <div>
                                <p class="text-white/90 text-sm font-medium mb-2">Audit Selesai</p>
                                <h3 class="text-6xl font-bold mb-3">{{ $completedPrograms }}</h3>
                                <p class="text-white/80 text-sm">
                                    @if($completedPrograms > 0)
                                        Program completed
                                    @else
                                        Belum ada yang selesai
                                    @endif
                                </p>
                            </div>
                            <div class="w-14 h-14 bg-white/25 backdrop-blur-sm rounded-2xl flex items-center justify-center group-hover:rotate-12 transition-transform">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Bar Chart: Monthly Statistics -->
                <div class="lg:col-span-2 bg-white rounded-3xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Statistik Program Audit</h3>
                        <div class="flex items-center space-x-4 text-sm">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-cyan-400 rounded-full mr-2"></div>
                                <span class="text-gray-600">Dibuat</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-purple-400 rounded-full mr-2"></div>
                                <span class="text-gray-600">Selesai</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Simple Bar Chart -->
                    <div class="h-64 flex items-end justify-between space-x-2">
                        @foreach($monthlyStats as $stat)
                        <div class="flex-1 flex flex-col items-center">
                            <div class="w-full flex items-end justify-center space-x-1 h-48">
                                <!-- Created bar -->
                                <div class="flex-1 bg-gradient-to-t from-cyan-400 to-cyan-300 rounded-t-lg hover:from-cyan-500 hover:to-cyan-400 transition-all cursor-pointer relative group"
                                     style="height: {{ $stat['created'] > 0 ? ($stat['created'] * 20) : 5 }}%">
                                    <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                        {{ $stat['created'] }} dibuat
                                    </div>
                                </div>
                                <!-- Completed bar -->
                                <div class="flex-1 bg-gradient-to-t from-purple-400 to-purple-300 rounded-t-lg hover:from-purple-500 hover:to-purple-400 transition-all cursor-pointer relative group"
                                     style="height: {{ $stat['completed'] > 0 ? ($stat['completed'] * 20) : 5 }}%">
                                    <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                        {{ $stat['completed'] }} selesai
                                    </div>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mt-2 font-medium">{{ $stat['month'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Donut Chart: Question Status Distribution -->
                <div class="bg-white rounded-3xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Status Pertanyaan</h3>
                    
                    <!-- Donut Chart (CSS-based) -->
                    <div class="flex items-center justify-center mb-6">
                        <div class="relative w-48 h-48">
                            <!-- Donut segments -->
                            <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                                <!-- Background circle -->
                                <circle cx="50" cy="50" r="40" fill="none" stroke="#f3f4f6" stroke-width="20"/>
                                
                                @php
                                    $total = $questionDistribution['open'] + $questionDistribution['in_progress'] + $questionDistribution['closed'];
                                    $openPercent = $total > 0 ? ($questionDistribution['open'] / $total) * 100 : 0;
                                    $inProgressPercent = $total > 0 ? ($questionDistribution['in_progress'] / $total) * 100 : 0;
                                    $closedPercent = $total > 0 ? ($questionDistribution['closed'] / $total) * 100 : 0;
                                    
                                    $circumference = 2 * 3.14159 * 40;
                                    $openDash = ($openPercent / 100) * $circumference;
                                    $inProgressDash = ($inProgressPercent / 100) * $circumference;
                                    $closedDash = ($closedPercent / 100) * $circumference;
                                    
                                    $openOffset = 0;
                                    $inProgressOffset = $openDash;
                                    $closedOffset = $openDash + $inProgressDash;
                                @endphp
                                
                                <!-- Open (Red/Pink) -->
                                <circle cx="50" cy="50" r="40" fill="none" 
                                        stroke="#fb7185" stroke-width="20"
                                        stroke-dasharray="{{ $openDash }} {{ $circumference }}"
                                        stroke-dashoffset="{{ $openOffset }}"
                                        class="transition-all duration-500"/>
                                
                                <!-- In Progress (Cyan) -->
                                <circle cx="50" cy="50" r="40" fill="none" 
                                        stroke="#67e8f9" stroke-width="20"
                                        stroke-dasharray="{{ $inProgressDash }} {{ $circumference }}"
                                        stroke-dashoffset="-{{ $inProgressOffset }}"
                                        class="transition-all duration-500"/>
                                
                                <!-- Closed (Green) -->
                                <circle cx="50" cy="50" r="40" fill="none" 
                                        stroke="#6ee7b7" stroke-width="20"
                                        stroke-dasharray="{{ $closedDash }} {{ $circumference }}"
                                        stroke-dashoffset="-{{ $closedOffset }}"
                                        class="transition-all duration-500"/>
                            </svg>
                            
                            <!-- Center text -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center">
                                    <p class="text-4xl font-bold text-gray-900">{{ $totalQuestions }}</p>
                                    <p class="text-sm text-gray-500 mt-1">Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Legend with colorful badges -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-pink-50 to-red-50 rounded-xl hover:from-pink-100 hover:to-red-100 transition-all">
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-gradient-to-br from-pink-400 to-red-400 rounded-full mr-3 shadow-sm"></div>
                                <span class="text-sm font-medium text-gray-700">Open</span>
                            </div>
                            <span class="text-lg font-bold text-gray-900">{{ $openQuestions }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl hover:from-cyan-100 hover:to-blue-100 transition-all">
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-gradient-to-br from-cyan-400 to-blue-400 rounded-full mr-3 shadow-sm"></div>
                                <span class="text-sm font-medium text-gray-700">In Progress</span>
                            </div>
                            <span class="text-lg font-bold text-gray-900">{{ $inProgressQuestions }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl hover:from-green-100 hover:to-emerald-100 transition-all">
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-gradient-to-br from-green-400 to-emerald-400 rounded-full mr-3 shadow-sm"></div>
                                <span class="text-sm font-medium text-gray-700">Closed</span>
                            </div>
                            <span class="text-lg font-bold text-gray-900">{{ $closedQuestions }}</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Recent Programs -->
            <div class="bg-white rounded-3xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-gray-900">Program Terbaru</h3>
                    <a href="{{ route('rkia.program') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                        Lihat Semua →
                    </a>
                </div>
                <div class="space-y-3">
                    @forelse($recentPrograms as $index => $program)
                        @php
                            $gradients = [
                                'from-purple-400 to-pink-500',
                                'from-blue-400 to-cyan-500',
                                'from-green-400 to-emerald-500',
                                'from-orange-400 to-red-500',
                                'from-indigo-400 to-purple-500',
                            ];
                            $gradient = $gradients[$index % count($gradients)];
                        @endphp
                        <a href="{{ route('audit-programs.show', $program) }}" 
                           class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl hover:from-gray-100 hover:to-gray-200 hover:shadow-md transition-all group">
                            <div class="flex items-center flex-1 min-w-0">
                                <div class="w-14 h-14 bg-gradient-to-br {{ $gradient }} rounded-2xl flex items-center justify-center text-white font-bold text-base mr-4 flex-shrink-0 group-hover:scale-110 group-hover:rotate-3 transition-transform shadow-lg">
                                    {{ substr($program->auditTimeline->department->code ?? 'N/A', 0, 2) }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="font-bold text-gray-900 truncate text-base">{{ $program->program_name }}</p>
                                    <p class="text-sm text-gray-600 mt-1">{{ $program->auditTimeline->department->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <span class="px-4 py-2 {{ $program->status === 'active' ? 'bg-gradient-to-r from-green-400 to-emerald-500 text-white' : ($program->status === 'draft' ? 'bg-gradient-to-r from-gray-300 to-gray-400 text-gray-700' : 'bg-gradient-to-r from-blue-400 to-cyan-500 text-white') }} text-xs font-bold rounded-xl ml-4 flex-shrink-0 shadow-sm">
                                {{ ucfirst($program->status) }}
                            </span>
                        </a>
                    @empty
                        <div class="text-center py-12">
                            <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-purple-100 rounded-3xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <p class="text-gray-600 font-medium mb-4">Belum ada program audit</p>
                            <a href="{{ route('rkia.timeline') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-cyan-600 shadow-lg hover:shadow-xl transition-all">
                                Buat Timeline Audit
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

    @else
        <!-- Keep existing dashboard for other roles -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-4">Dashboard {{ ucfirst($userRole) }}</h2>
            <p class="text-gray-600">Selamat datang, {{ Auth::user()->name }}</p>
        </div>
    @endif

</x-app-layout>
