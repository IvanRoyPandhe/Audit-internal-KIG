<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="badge">Terbaru</x-slot>

    <!-- Decorative Background Elements -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden -z-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 left-0 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-0 right-1/3 w-96 h-96 bg-pink-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Stats Cards with Enhanced Design -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Total Audit -->
        <div class="relative bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 overflow-hidden transform hover:scale-105 transition duration-300 group" x-data="{ count: 0 }" x-init="setInterval(() => { if(count < 24) count++ }, 50)">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="px-3 py-1 bg-white bg-opacity-20 backdrop-blur-sm rounded-full text-xs font-semibold text-white">+12%</span>
                </div>
                <p class="text-blue-100 text-sm mb-1">Total Audit</p>
                <h3 class="text-4xl font-bold text-white mb-2" x-text="count"></h3>
                <p class="text-blue-100 text-xs">Audit terjadwal tahun ini</p>
            </div>
        </div>

        <!-- Audit Selesai -->
        <div class="relative bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-xl p-6 overflow-hidden transform hover:scale-105 transition duration-300 group" x-data="{ count: 0 }" x-init="setInterval(() => { if(count < 18) count++ }, 60)">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="px-3 py-1 bg-white bg-opacity-20 backdrop-blur-sm rounded-full text-xs font-semibold text-white">75%</span>
                </div>
                <p class="text-green-100 text-sm mb-1">Audit Selesai</p>
                <h3 class="text-4xl font-bold text-white mb-2" x-text="count"></h3>
                <p class="text-green-100 text-xs">Laporan telah diselesaikan</p>
            </div>
        </div>

        <!-- Audit Berjalan -->
        <div class="relative bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl shadow-xl p-6 overflow-hidden transform hover:scale-105 transition duration-300 group" x-data="{ count: 0 }" x-init="setInterval(() => { if(count < 6) count++ }, 150)">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white animate-spin" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="px-3 py-1 bg-white bg-opacity-20 backdrop-blur-sm rounded-full text-xs font-semibold text-white animate-pulse">Live</span>
                </div>
                <p class="text-yellow-100 text-sm mb-1">Audit Berjalan</p>
                <h3 class="text-4xl font-bold text-white mb-2" x-text="count"></h3>
                <p class="text-yellow-100 text-xs">Sedang dalam proses</p>
            </div>
        </div>
    </div>

    <!-- Welcome Banner with Ornaments -->
    <div class="relative bg-gradient-to-r from-blue-600 via-blue-500 to-indigo-600 rounded-2xl shadow-2xl p-8 mb-6 text-white overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full -ml-24 -mb-24"></div>
        <div class="absolute top-1/2 right-10 transform -translate-y-1/2">
            <div class="relative">
                <div class="w-32 h-32 bg-white bg-opacity-10 rounded-full animate-pulse"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="relative z-10">
            <div class="flex items-center mb-3">
                <span class="text-4xl mr-3 animate-bounce">👋</span>
                <h3 class="text-3xl font-bold">Selamat datang kembali!</h3>
            </div>
            <p class="text-xl font-semibold mb-2">{{ Auth::user()->name }}</p>
            <p class="text-blue-100 max-w-2xl">Kelola dan pantau seluruh aktivitas audit dari dashboard ini. Sistem terintegrasi untuk efisiensi maksimal.</p>
            <div class="flex items-center space-x-4 mt-4">
                <div class="flex items-center">
                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                    <span class="text-sm text-blue-100">Sistem Online</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm text-blue-100">{{ now()->translatedFormat('H:i') }} WIB</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section with Enhanced Design -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Audit Per Bulan -->
        <div class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transition duration-300 border border-gray-100" x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h4 class="text-lg font-bold text-gray-800 flex items-center">
                        <span class="w-1 h-6 bg-blue-600 rounded-full mr-2"></span>
                        Audit Per Bulan
                    </h4>
                    <p class="text-xs text-gray-500 mt-1">Statistik 6 bulan terakhir</p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                    </svg>
                </div>
            </div>
            <div class="h-64 flex items-end justify-between space-x-3">
                <div class="flex-1 group cursor-pointer" style="height: 40%">
                    <div class="h-full bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-xl hover:from-blue-500 hover:to-blue-600 transition-all duration-300 relative">
                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-gray-800 text-white text-xs px-2 py-1 rounded">4</div>
                    </div>
                </div>
                <div class="flex-1 group cursor-pointer" style="height: 60%">
                    <div class="h-full bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-xl hover:from-blue-500 hover:to-blue-600 transition-all duration-300 relative">
                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-gray-800 text-white text-xs px-2 py-1 rounded">6</div>
                    </div>
                </div>
                <div class="flex-1 group cursor-pointer" style="height: 80%">
                    <div class="h-full bg-gradient-to-t from-blue-500 to-blue-600 rounded-t-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 relative">
                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-gray-800 text-white text-xs px-2 py-1 rounded">8</div>
                    </div>
                </div>
                <div class="flex-1 group cursor-pointer" style="height: 95%">
                    <div class="h-full bg-gradient-to-t from-blue-600 to-blue-700 rounded-t-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 relative">
                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-gray-800 text-white text-xs px-2 py-1 rounded">10</div>
                    </div>
                </div>
                <div class="flex-1 group cursor-pointer" style="height: 70%">
                    <div class="h-full bg-gradient-to-t from-blue-500 to-blue-600 rounded-t-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 relative">
                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-gray-800 text-white text-xs px-2 py-1 rounded">7</div>
                    </div>
                </div>
                <div class="flex-1 group cursor-pointer" style="height: 50%">
                    <div class="h-full bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-xl hover:from-blue-500 hover:to-blue-600 transition-all duration-300 relative">
                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-gray-800 text-white text-xs px-2 py-1 rounded">5</div>
                    </div>
                </div>
            </div>
            <div class="flex justify-between mt-4 text-xs font-medium text-gray-500">
                <span>Jul</span>
                <span>Agu</span>
                <span>Sep</span>
                <span>Okt</span>
                <span>Nov</span>
                <span>Des</span>
            </div>
        </div>

        <!-- Status Temuan Audit - Pie Chart -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-6 hover:shadow-2xl transition duration-300 border border-gray-100" x-data="{
            hoveredIndex: null,
            data: [
                { label: 'Sesuai', value: 45, color: '#10b981', icon: '✓' },
                { label: 'Tidak Sesuai', value: 30, color: '#ef4444', icon: '✗' },
                { label: 'Menyimpang', value: 15, color: '#f59e0b', icon: '⚠' },
                { label: 'Melampaui', value: 10, color: '#3b82f6', icon: '↑' }
            ]
        }">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h4 class="text-lg font-bold text-gray-800 flex items-center">
                        <span class="w-1 h-6 bg-gradient-to-b from-green-600 to-red-600 rounded-full mr-2"></span>
                        Kategori Temuan Audit
                    </h4>
                    <p class="text-xs text-gray-500 mt-1">Distribusi hasil audit</p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"/>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"/>
                    </svg>
                </div>
            </div>
            <div class="flex items-center justify-between gap-6">
                <div class="flex-1 flex items-center justify-center relative">
                    <svg viewBox="0 0 200 200" class="w-72 h-72">
                        <!-- Sesuai 45% -->
                        <path d="M 100 25 A 75 75 0 0 1 175 100 L 100 100 Z" fill="#10b981" class="cursor-pointer transition-all duration-300 drop-shadow-lg" :class="hoveredIndex === 0 ? 'opacity-100' : 'opacity-90'" @mouseenter="hoveredIndex = 0" @mouseleave="hoveredIndex = null" transform-origin="100 100" :style="hoveredIndex === 0 ? 'transform: scale(1.08)' : ''"/>
                        <!-- Tidak Sesuai 30% -->
                        <path d="M 175 100 A 75 75 0 0 1 100 175 L 100 100 Z" fill="#ef4444" class="cursor-pointer transition-all duration-300 drop-shadow-lg" :class="hoveredIndex === 1 ? 'opacity-100' : 'opacity-90'" @mouseenter="hoveredIndex = 1" @mouseleave="hoveredIndex = null" transform-origin="100 100" :style="hoveredIndex === 1 ? 'transform: scale(1.08)' : ''"/>
                        <!-- Menyimpang 15% -->
                        <path d="M 100 175 A 75 75 0 0 1 46.4 154 L 100 100 Z" fill="#f59e0b" class="cursor-pointer transition-all duration-300 drop-shadow-lg" :class="hoveredIndex === 2 ? 'opacity-100' : 'opacity-90'" @mouseenter="hoveredIndex = 2" @mouseleave="hoveredIndex = null" transform-origin="100 100" :style="hoveredIndex === 2 ? 'transform: scale(1.08)' : ''"/>
                        <!-- Melampaui 10% -->
                        <path d="M 46.4 154 A 75 75 0 0 1 100 25 L 100 100 Z" fill="#3b82f6" class="cursor-pointer transition-all duration-300 drop-shadow-lg" :class="hoveredIndex === 3 ? 'opacity-100' : 'opacity-90'" @mouseenter="hoveredIndex = 3" @mouseleave="hoveredIndex = null" transform-origin="100 100" :style="hoveredIndex === 3 ? 'transform: scale(1.08)' : ''/>
                        
                        <!-- Center hole with gradient -->
                        <circle cx="100" cy="100" r="55" fill="url(#centerGradient)"/>
                        <defs>
                            <linearGradient id="centerGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#f9fafb;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#f3f4f6;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                    
                        <!-- Percentage on hover -->
                        <text x="100" y="105" text-anchor="middle" class="text-3xl font-bold transition-opacity duration-300" :class="hoveredIndex !== null ? 'opacity-100' : 'opacity-0'" :fill="data[hoveredIndex]?.color || '#000'">
                            <tspan x-text="data[hoveredIndex]?.value + '%'"></tspan>
                        </text>
                    </svg>
                </div>
                
                <!-- Legend -->
                <div class="flex-1 space-y-3">
                    <template x-for="(item, index) in data" :key="index">
                        <div class="flex items-center justify-between p-3 rounded-xl transition-all duration-300 cursor-pointer" :class="hoveredIndex === index ? 'bg-gray-100 shadow-md scale-105' : 'bg-white shadow'" @mouseenter="hoveredIndex = index" @mouseleave="hoveredIndex = null">
                            <div class="flex items-center space-x-3">
                                <div class="w-4 h-4 rounded-full shadow-inner" :style="`background-color: ${item.color}`"></div>
                                <span class="text-sm font-semibold text-gray-700" x-text="item.icon + ' ' + item.label"></span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-lg font-bold text-gray-800" x-text="item.value + '%'"></span>
                                <span class="text-xs text-gray-500" x-text="'(' + Math.round(item.value) + ')'"></span>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick Access with Enhanced Design -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-xl font-bold text-gray-800 flex items-center">
                <span class="w-1 h-8 bg-blue-600 rounded-full mr-3"></span>
                Quick Access
            </h4>
            <button class="text-blue-600 hover:text-blue-700 text-sm font-semibold flex items-center">
                Lihat Semua
                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="#" class="group relative bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 text-center transform hover:-translate-y-2 overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-blue-50 rounded-full -mr-10 -mt-10 group-hover:scale-150 transition-transform duration-300"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-800 group-hover:text-blue-600 transition duration-300">Buat Audit Baru</p>
                </div>
            </a>
            <a href="#" class="group relative bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 text-center transform hover:-translate-y-2 overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-green-50 rounded-full -mr-10 -mt-10 group-hover:scale-150 transition-transform duration-300"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-800 group-hover:text-green-600 transition duration-300">Lihat Laporan</p>
                </div>
            </a>
            <a href="#" class="group relative bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 text-center transform hover:-translate-y-2 overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-purple-50 rounded-full -mr-10 -mt-10 group-hover:scale-150 transition-transform duration-300"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-800 group-hover:text-purple-600 transition duration-300">Timeline RKIA</p>
                </div>
            </a>
            <a href="#" class="group relative bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 text-center transform hover:-translate-y-2 overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-orange-50 rounded-full -mr-10 -mt-10 group-hover:scale-150 transition-transform duration-300"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-800 group-hover:text-orange-600 transition duration-300">Kelola Users</p>
                </div>
            </a>
        </div>
    </div>
    <!-- Recent Activities with Enhanced Design -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden" x-data="{ show: false }" x-init="setTimeout(() => show = true, 600)">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h4 class="text-lg font-bold text-gray-800 flex items-center">
                    <span class="w-1 h-6 bg-blue-600 rounded-full mr-2"></span>
                    Aktivitas Terbaru
                    <span class="ml-3 px-2 py-1 bg-blue-100 text-blue-600 text-xs font-semibold rounded-full">3 Baru</span>
                </h4>
                <button class="text-blue-600 hover:text-blue-700 text-sm font-semibold">Lihat Semua</button>
            </div>
        </div>
        <div class="divide-y divide-gray-100" x-show="show" x-transition>
            <div class="p-5 hover:bg-blue-50 transition duration-200 transform hover:translate-x-2 cursor-pointer group">
                <div class="flex items-start justify-between">
                    <div class="flex items-start space-x-4">
                        <div class="relative">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full border-2 border-white animate-pulse"></div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800 mb-1">Audit Keuangan Q4 2025 dimulai</p>
                            <p class="text-xs text-gray-500 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                2 jam yang lalu
                            </p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">Baru</span>
                </div>
            </div>
            <div class="p-5 hover:bg-green-50 transition duration-200 transform hover:translate-x-2 cursor-pointer group">
                <div class="flex items-start justify-between">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800 mb-1">Laporan Audit Operasional telah diselesaikan</p>
                            <p class="text-xs text-gray-500 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                5 jam yang lalu
                            </p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Selesai</span>
                </div>
            </div>
            <div class="p-5 hover:bg-yellow-50 transition duration-200 transform hover:translate-x-2 cursor-pointer group">
                <div class="flex items-start justify-between">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800 mb-1">Temuan kritis pada Audit IT memerlukan tindak lanjut</p>
                            <p class="text-xs text-gray-500 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                1 hari yang lalu
                            </p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">Perhatian</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(20px, -50px) scale(1.1); }
            50% { transform: translate(-20px, 20px) scale(0.9); }
            75% { transform: translate(50px, 50px) scale(1.05); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>


</x-app-layout>
