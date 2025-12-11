<x-app-layout>
    <x-slot name="title">Audit Saya</x-slot>

    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Audit Departemen Saya</h2>
                    <p class="text-gray-600 mb-4">
                        Departemen: <span class="font-semibold">{{ Auth::user()->department ? Auth::user()->department->name : '-' }}</span>
                        @if(Auth::user()->is_department_head)
                            <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Senior Manager</span>
                        @endif
                    </p>
                    
                    <!-- Info untuk SM -->
                    @if(Auth::user()->is_department_head)
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                            <div class="flex">
                                <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                <div class="text-sm text-blue-700">
                                    <p class="font-semibold mb-1">Anda adalah Senior Manager</p>
                                    <p>Anda akan menerima email notifikasi saat departemen mendapat jadwal audit. Anda dan team dapat mengerjakan audit bersama-sama.</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
                            <div class="flex">
                                <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1 a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                <div class="text-sm text-green-700">
                                    <p class="font-semibold mb-1">Employee Departemen</p>
                                    <p>Anda dapat mengerjakan audit bersama dengan Senior Manager dan team lainnya.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Audit Programs List -->
        <div class="bg-white rounded-xl shadow">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Program Audit Aktif</h3>
                        <p class="text-sm text-gray-600 mt-1">Daftar audit yang perlu dikerjakan</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Audit</h3>
                    <p class="text-gray-600">Anda akan menerima notifikasi saat ada audit baru untuk departemen Anda</p>
                </div>

                <!-- Example Audit Program Card (akan diisi dengan data real) -->
                <!--
                <div class="space-y-4">
                    <div class="border-2 border-yellow-500 rounded-xl p-6 bg-yellow-50">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center">
                                    <h4 class="font-bold text-gray-900 text-lg">Audit Keuangan Q1 2025</h4>
                                    <span class="ml-2 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">In Progress</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">Program Audit Finance Department</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                            <div class="bg-white rounded-lg p-3">
                                <p class="text-xs text-gray-600 mb-1">Total Pertanyaan</p>
                                <p class="text-2xl font-bold text-gray-900">25</p>
                            </div>
                            <div class="bg-white rounded-lg p-3">
                                <p class="text-xs text-gray-600 mb-1">Belum Dijawab</p>
                                <p class="text-2xl font-bold text-red-600">10</p>
                            </div>
                            <div class="bg-white rounded-lg p-3">
                                <p class="text-xs text-gray-600 mb-1">In Progress</p>
                                <p class="text-2xl font-bold text-yellow-600">8</p>
                            </div>
                            <div class="bg-white rounded-lg p-3">
                                <p class="text-xs text-gray-600 mb-1">Selesai</p>
                                <p class="text-2xl font-bold text-green-600">7</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                <span>Deadline: 28 Feb 2025</span>
                                <span class="ml-3 px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">5 hari lagi</span>
                            </div>
                            <button class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700">
                                Kerjakan Audit
                            </button>
                        </div>
                    </div>

                    <div class="border-2 border-green-500 rounded-xl p-6 bg-green-50">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center">
                                    <h4 class="font-bold text-gray-900 text-lg">Audit IT Security 2024</h4>
                                    <span class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Completed</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">Program Audit IT Department</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                            <div class="bg-white rounded-lg p-3">
                                <p class="text-xs text-gray-600 mb-1">Total Pertanyaan</p>
                                <p class="text-2xl font-bold text-gray-900">30</p>
                            </div>
                            <div class="bg-white rounded-lg p-3">
                                <p class="text-xs text-gray-600 mb-1">Belum Dijawab</p>
                                <p class="text-2xl font-bold text-gray-400">0</p>
                            </div>
                            <div class="bg-white rounded-lg p-3">
                                <p class="text-xs text-gray-600 mb-1">In Progress</p>
                                <p class="text-2xl font-bold text-gray-400">0</p>
                            </div>
                            <div class="bg-white rounded-lg p-3">
                                <p class="text-xs text-gray-600 mb-1">Selesai</p>
                                <p class="text-2xl font-bold text-green-600">30</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Selesai: 15 Des 2024</span>
                            </div>
                            <button class="px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-50">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
                -->
            </div>
        </div>

        <!-- Info Box -->
        <div class="bg-purple-50 border-l-4 border-purple-500 p-4 rounded">
            <div class="flex">
                <svg class="w-5 h-5 text-purple-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div class="text-sm text-purple-700">
                    <p class="font-semibold mb-1">Cara Mengerjakan Audit:</p>
                    <ul class="list-disc list-inside space-y-1">
                        <li>Jawab setiap pertanyaan dengan lengkap</li>
                        <li>Upload dokumen pendukung yang diminta</li>
                        <li>Anda dapat menyimpan sebagai draft dan melanjutkan nanti</li>
                        <li>SM dan Employee dapat mengerjakan bersama-sama</li>
                        <li>Auditor akan memberikan feedback jika perlu revisi</li>
                        <li>Status akan berubah menjadi "Closed" setelah disetujui auditor</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
