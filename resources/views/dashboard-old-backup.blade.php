<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    @php
        $userRole = Auth::user()->role->name;
    @endphp

    @if($userRole === 'admin')
        <!-- ADMIN DASHBOARD -->
        <div class="space-y-6">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 rounded-2xl shadow-2xl p-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -ml-24 -mb-24"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-200 text-sm mb-2">{{ now()->format('l, d F Y') }}</p>
                            <h2 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}</h2>
                            <p class="text-blue-100 text-lg">Administrator - Kelola sistem audit PT KIG</p>
                        </div>
                        <div class="hidden md:block">
                            <div class="w-24 h-24 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards with Gradient -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Departemen -->
                <div class="relative rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-400 to-pink-500"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/20 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full -ml-12 -mb-12"></div>
                    <div class="relative p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-white/80 text-sm font-medium">Total Departemen</p>
                            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-4xl font-bold mb-1">{{ $totalDepartments }}</h3>
                        <p class="text-white/70 text-xs">{{ $activeDepartments }} Aktif</p>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="relative rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-cyan-500"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/20 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full -ml-12 -mb-12"></div>
                    <div class="relative p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-white/80 text-sm font-medium">Total Users</p>
                            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-4xl font-bold mb-1">{{ $totalUsers }}</h3>
                        <p class="text-white/70 text-xs">Terdaftar di sistem</p>
                    </div>
                </div>

                <!-- Timeline Tahun Ini -->
                <div class="relative rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-400 to-emerald-500"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/20 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full -ml-12 -mb-12"></div>
                    <div class="relative p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-white/80 text-sm font-medium">Timeline {{ date('Y') }}</p>
                            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-4xl font-bold mb-1">{{ $timelinesThisYear }}</h3>
                        <p class="text-white/70 text-xs">Jadwal audit</p>
                    </div>
                </div>

                <!-- Program Aktif -->
                <div class="relative rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-400 to-indigo-500"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/20 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full -ml-12 -mb-12"></div>
                    <div class="relative p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-white/80 text-sm font-medium">Program Aktif</p>
                            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-4xl font-bold mb-1">{{ $activePrograms }}</h3>
                        <p class="text-white/70 text-xs">Sedang berjalan</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"/>
                            <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"/>
                        </svg>
                        Quick Actions
                    </h3>
                    <div class="space-y-3">
                        <a href="{{ route('departments.create') }}" class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl hover:from-blue-100 hover:to-blue-200 transition-all duration-200 group">
                            <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Tambah Departemen</p>
                                <p class="text-xs text-gray-600">Buat departemen baru</p>
                            </div>
                        </a>

                        <a href="{{ route('users.create') }}" class="flex items-center p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-xl hover:from-green-100 hover:to-green-200 transition-all duration-200 group">
                            <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Tambah User</p>
                                <p class="text-xs text-gray-600">Buat user baru</p>
                            </div>
                        </a>

                        <a href="{{ route('departments.index') }}" class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl hover:from-purple-100 hover:to-purple-200 transition-all duration-200 group">
                            <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Kelola Departemen</p>
                                <p class="text-xs text-gray-600">Lihat semua departemen</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Recent Departments -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        Departemen Terbaru
                    </h3>
                    <div class="space-y-3">
                        @forelse($recentDepartments as $dept)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-purple-500 rounded-lg flex items-center justify-center text-white font-bold text-sm mr-3">
                                        {{ substr($dept->code, 0, 2) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 text-sm">{{ $dept->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $dept->code }}</p>
                                    </div>
                                </div>
                                <span class="px-2 py-1 {{ $dept->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }} text-xs font-medium rounded-full">
                                    {{ $dept->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 text-sm py-4">Belum ada departemen</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    @elseif($userRole === 'auditor')
        <!-- AUDITOR DASHBOARD -->
        <div class="space-y-6">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-800 rounded-2xl shadow-2xl p-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -ml-24 -mb-24"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-200 text-sm mb-2">{{ now()->format('l, d F Y') }}</p>
                            <h2 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}</h2>
                            <p class="text-purple-100 text-lg">Auditor - Kelola timeline dan program audit</p>
                        </div>
                        <div class="hidden md:block">
                            <div class="w-24 h-24 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Timeline Aktif -->
                <div class="relative rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-cyan-500"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/20 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-white/80 text-sm font-medium">Timeline Aktif</p>
                            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-4xl font-bold mb-1">{{ $activeTimelines }}</h3>
                        <p class="text-white/70 text-xs">Tahun {{ date('Y') }}</p>
                    </div>
                </div>

                <!-- Program Aktif -->
                <div class="relative rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-400 to-pink-500"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/20 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-white/80 text-sm font-medium">Program Aktif</p>
                            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-4xl font-bold mb-1">{{ $activePrograms }}</h3>
                        <p class="text-white/70 text-xs">{{ $draftPrograms }} Draft</p>
                    </div>
                </div>

                <!-- Perlu Review -->
                <div class="relative rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-400 to-red-500"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/20 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-white/80 text-sm font-medium">Perlu Review</p>
                            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-4xl font-bold mb-1">{{ $questionsNeedReview }}</h3>
                        <p class="text-white/70 text-xs">Pertanyaan In Progress</p>
                    </div>
                </div>

                <!-- Audit Selesai -->
                <div class="relative rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-400 to-emerald-500"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/20 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-white/80 text-sm font-medium">Audit Selesai</p>
                            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-4xl font-bold mb-1">{{ $completedPrograms }}</h3>
                        <p class="text-white/70 text-xs">Program completed</p>
                    </div>
                </div>
            </div>

            <!-- Questions Overview -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                    </svg>
                    Status Pertanyaan Audit
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4">
                        <p class="text-sm text-gray-600 mb-1">Total Pertanyaan</p>
                        <h4 class="text-2xl font-bold text-gray-900">{{ $totalQuestions }}</h4>
                    </div>
                    <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-4">
                        <p class="text-sm text-red-600 mb-1">Open</p>
                        <h4 class="text-2xl font-bold text-red-700">{{ $openQuestions }}</h4>
                    </div>
                    <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl p-4">
                        <p class="text-sm text-yellow-600 mb-1">In Progress</p>
                        <h4 class="text-2xl font-bold text-yellow-700">{{ $inProgressQuestions }}</h4>
                    </div>
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4">
                        <p class="text-sm text-green-600 mb-1">Closed</p>
                        <h4 class="text-2xl font-bold text-green-700">{{ $closedQuestions }}</h4>
                    </div>
                </div>
            </div>

            <!-- Workflow & Recent Programs -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Workflow -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Alur Kerja Audit</h3>
                    <div class="space-y-4">
                        <a href="{{ route('rkia.timeline') }}" class="flex items-start p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl hover:from-blue-100 hover:to-blue-200 transition group">
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold mr-4 flex-shrink-0 group-hover:scale-110 transition">
                                1
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Buat Timeline</h4>
                                <p class="text-sm text-gray-600 mt-1">Tentukan jadwal audit untuk setiap departemen</p>
                            </div>
                        </a>

                        <a href="{{ route('rkia.program') }}" class="flex items-start p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl hover:from-purple-100 hover:to-purple-200 transition group">
                            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold mr-4 flex-shrink-0 group-hover:scale-110 transition">
                                2
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Buat Program</h4>
                                <p class="text-sm text-gray-600 mt-1">Input pertanyaan audit untuk departemen</p>
                            </div>
                        </a>

                        <a href="{{ route('laporan.index') }}" class="flex items-start p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-xl hover:from-green-100 hover:to-green-200 transition group">
                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-bold mr-4 flex-shrink-0 group-hover:scale-110 transition">
                                3
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Review & Laporan</h4>
                                <p class="text-sm text-gray-600 mt-1">Review jawaban dan buat laporan audit</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Recent Programs -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        Program Terbaru
                    </h3>
                    <div class="space-y-3">
                        @forelse($recentPrograms as $program)
                            <a href="{{ route('audit-programs.show', $program) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="flex items-center flex-1 min-w-0">
                                    <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-500 rounded-lg flex items-center justify-center text-white font-bold text-xs mr-3 flex-shrink-0">
                                        {{ substr($program->auditTimeline->department->code ?? 'N/A', 0, 2) }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="font-semibold text-gray-900 text-sm truncate">{{ $program->program_name }}</p>
                                        <p class="text-xs text-gray-500">{{ $program->auditTimeline->department->name ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <span class="px-2 py-1 {{ $program->status === 'active' ? 'bg-green-100 text-green-700' : ($program->status === 'draft' ? 'bg-gray-200 text-gray-600' : 'bg-blue-100 text-blue-700') }} text-xs font-medium rounded-full ml-2 flex-shrink-0">
                                    {{ ucfirst($program->status) }}
                                </span>
                            </a>
                        @empty
                            <p class="text-center text-gray-500 text-sm py-4">Belum ada program</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    @elseif(in_array($userRole, ['auditee_sm', 'auditee_em']))
        <!-- AUDITEE DASHBOARD -->
        <div class="space-y-6">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}</h2>
                        <p class="text-green-100">
                            {{ Auth::user()->department ? Auth::user()->department->name : 'Auditee' }}
                            @if(Auth::user()->is_department_head) - Senior Manager @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Alert if SM -->
            @if(Auth::user()->is_department_head)
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                    <div class="flex">
                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="text-sm text-blue-700 font-semibold">Anda adalah Senior Manager departemen ini</p>
                            <p class="text-xs text-blue-600 mt-1">Anda akan menerima notifikasi email saat departemen mendapat jadwal audit</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Audit Status -->
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Audit Departemen</h3>
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="text-gray-600">Belum ada audit yang dijadwalkan</p>
                    <p class="text-sm text-gray-500 mt-1">Anda akan menerima notifikasi saat ada audit baru</p>
                </div>
            </div>
        </div>

    @else
        <!-- PIMPINAN DASHBOARD -->
        <div class="space-y-6">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}</h2>
                        <p class="text-indigo-100">Pimpinan - Monitoring dan Laporan Audit</p>
                    </div>
                </div>
            </div>

            <!-- Overview Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-sm text-gray-600 mb-1">Total Departemen</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ \App\Models\Department::count() }}</h3>
                </div>
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-sm text-gray-600 mb-1">Audit Tahun Ini</p>
                    <h3 class="text-3xl font-bold text-gray-900">0</h3>
                </div>
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-sm text-gray-600 mb-1">Audit Selesai</p>
                    <h3 class="text-3xl font-bold text-gray-900">0</h3>
                </div>
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-sm text-gray-600 mb-1">Temuan</p>
                    <h3 class="text-3xl font-bold text-gray-900">0</h3>
                </div>
            </div>

            <!-- Quick Access -->
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Akses Cepat</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('laporan.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Laporan Audit</p>
                            <p class="text-xs text-gray-500">Lihat semua laporan</p>
                        </div>
                    </a>

                    <a href="{{ route('departments.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Departemen</p>
                            <p class="text-xs text-gray-500">Lihat departemen</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
