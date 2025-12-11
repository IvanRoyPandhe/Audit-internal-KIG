<x-app-layout>
    <x-slot name="title">Timeline Audit</x-slot>

    <div class="space-y-6" x-data="{ showImportModal: false }">
        <!-- Header dengan Instruksi -->
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Timeline Audit - RKIA</h2>
                    <p class="text-gray-600 mb-4">Tentukan jadwal audit untuk setiap departemen. Timeline yang dibuat akan menjadi dasar pembuatan program audit.</p>
                    
                    <!-- Workflow Info -->
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded mt-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <div class="text-sm text-blue-700">
                                <p class="font-semibold mb-1">Langkah 1: Buat Timeline Audit</p>
                                <ul class="list-disc list-inside space-y-1 text-blue-600">
                                    <li>Pilih departemen yang akan diaudit</li>
                                    <li>Tentukan tanggal mulai dan selesai audit</li>
                                    <li>Set status aktif untuk departemen yang mendapat jadwal audit tahun ini</li>
                                    <li>SM departemen akan otomatis menerima email notifikasi</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <!-- Buat Timeline Manual -->
                <a href="{{ route('rkia.timeline.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Timeline Manual
                </a>

                <!-- Import dari Excel - STYLING DIPERBAIKI -->
                <button @click="showImportModal = true" 
                        data-import-btn
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-green-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    Import dari Excel
                </button>
            </div>

            <!-- Download Template -->
            <a href="{{ route('rkia.timeline.download-template') }}" 
               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Download Template Excel
            </a>
        </div>

        <!-- Timeline List / Calendar View -->
        <div class="bg-white rounded-xl shadow">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Timeline Audit Tahun {{ $year }}</h3>
                        <p class="text-sm text-gray-600 mt-1">Daftar jadwal audit per departemen</p>
                    </div>
                    <form method="GET" action="{{ route('rkia.timeline') }}">
                        <select name="year" onchange="this.form.submit()" class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            @foreach($years as $y)
                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            <div class="p-6">
                @if($timelines->count() > 0)
                    <div class="space-y-4">
                        @foreach($timelines as $timeline)
                            <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 transition">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center">
                                            <h4 class="font-semibold text-gray-900">{{ $timeline->department->name }}</h4>
                                            @if($timeline->is_active)
                                                <span class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Aktif</span>
                                            @else
                                                <span class="ml-2 px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">Tidak Aktif</span>
                                            @endif
                                            
                                            @if($timeline->status === 'scheduled')
                                                <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Terjadwal</span>
                                            @elseif($timeline->status === 'ongoing')
                                                <span class="ml-2 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Berjalan</span>
                                            @elseif($timeline->status === 'completed')
                                                <span class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Selesai</span>
                                            @else
                                                <span class="ml-2 px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Dibatalkan</span>
                                            @endif
                                        </div>
                                        <div class="flex items-center mt-2 text-sm text-gray-600 space-x-4">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                                </svg>
                                                <span>{{ $timeline->start_date->format('d M Y') }} - {{ $timeline->end_date->format('d M Y') }}</span>
                                            </div>
                                            @if($timeline->department->seniorManager)
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                                    </svg>
                                                    <span>SM: {{ $timeline->department->seniorManager->name }}</span>
                                                </div>
                                            @endif
                                            @if($timeline->email_sent)
                                                <div class="flex items-center text-green-600">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                                    </svg>
                                                    <span>Email terkirim</span>
                                                </div>
                                            @endif
                                        </div>
                                        @if($timeline->notes)
                                            <p class="text-sm text-gray-500 mt-2">{{ $timeline->notes }}</p>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('rkia.timeline.edit', $timeline) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('rkia.timeline.destroy', $timeline) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus timeline ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Timeline</h3>
                        <p class="text-gray-600 mb-6">Mulai dengan membuat timeline audit atau import dari Excel</p>
                        <div class="flex items-center justify-center space-x-3">
                            <a href="{{ route('rkia.timeline.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Buat Timeline
                            </a>
                            <button @click="showImportModal = true" 
                                    data-import-btn
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-green-700 hover:to-emerald-700 shadow-md transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                Import Excel
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Info Box -->
        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
            <div class="flex">
                <svg class="w-5 h-5 text-yellow-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <div class="text-sm text-yellow-700">
                    <p class="font-semibold">Catatan Penting:</p>
                    <ul class="list-disc list-inside mt-1 space-y-1">
                        <li>Tidak semua departemen harus diaudit setiap tahun</li>
                        <li>Departemen dengan status "Tidak Aktif" tidak akan muncul di Program Audit</li>
                        <li>Email notifikasi akan otomatis dikirim ke SM departemen setelah timeline dibuat</li>
                        <li>Timeline dapat diubah selama program audit belum dimulai</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Import Modal -->
        <div x-show="showImportModal" 
             x-cloak 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto" 
             style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                     @click="showImportModal = false"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"></div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                
                <!-- Modal panel -->
                <div class="relative inline-block align-bottom bg-white rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-emerald-500 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Import Timeline dari Excel</h3>
                        </div>
                        <button @click="showImportModal = false" 
                                class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-2 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <form action="{{ route('rkia.timeline.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Audit</label>
                                <input type="number" name="audit_year" value="{{ date('Y') }}" min="2020" max="2100" required
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">File Excel</label>
                                <input type="file" name="file" accept=".xlsx,.xls" required
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-gray-500 mt-1">Format: .xlsx atau .xls (Max: 2MB)</p>
                            </div>

                            <div class="bg-blue-50 border-l-4 border-blue-500 p-3 rounded">
                                <p class="text-sm text-blue-700">
                                    <strong>Catatan:</strong> Download template Excel terlebih dahulu, isi data sesuai format, lalu upload di sini.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-3 mt-6">
                            <button type="button" @click="showImportModal = false"
                                class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-green-600 border border-transparent rounded-lg text-sm font-semibold text-white hover:bg-green-700">
                                Import Timeline
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Fallback Modal (jika Alpine.js tidak bekerja) -->
        <div id="import-modal-fallback" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto bg-gray-500 bg-opacity-75">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                
                <div class="relative inline-block align-bottom bg-white rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-emerald-500 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Import Timeline dari Excel</h3>
                        </div>
                        <button data-close-modal class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-2 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <form action="{{ route('rkia.timeline.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Tahun Audit</label>
                                <input type="number" name="audit_year" value="{{ date('Y') }}" min="2020" max="2100" required
                                    class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 text-lg py-3">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">File Excel</label>
                                <input type="file" name="file" accept=".xlsx,.xls" required
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 file:cursor-pointer">
                                <p class="text-xs text-gray-500 mt-2">Format: .xlsx atau .xls (Max: 2MB)</p>
                            </div>

                            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-xl">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-sm text-green-700">
                                        <strong>Catatan:</strong> Download template Excel terlebih dahulu, isi data sesuai format, lalu upload di sini.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-3 mt-8">
                            <button type="button" data-close-modal
                                class="px-6 py-3 bg-white border-2 border-gray-300 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 border border-transparent rounded-xl text-sm font-semibold text-white hover:from-green-700 hover:to-emerald-700 shadow-lg transition-all">
                                Import Timeline
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>

    <!-- Fallback JavaScript jika Alpine.js tidak bekerja -->
    <script>
        // Fallback untuk browser yang tidak support Alpine.js
        document.addEventListener('DOMContentLoaded', function() {
            // Cek apakah Alpine.js sudah load
            setTimeout(function() {
                if (typeof Alpine === 'undefined') {
                    console.log('Alpine.js not loaded, using fallback');
                    
                    // Manual modal handling
                    const importButtons = document.querySelectorAll('[data-import-btn]');
                    const modal = document.getElementById('import-modal-fallback');
                    const closeButtons = document.querySelectorAll('[data-close-modal]');
                    
                    importButtons.forEach(btn => {
                        btn.addEventListener('click', () => {
                            if (modal) modal.style.display = 'block';
                        });
                    });
                    
                    closeButtons.forEach(btn => {
                        btn.addEventListener('click', () => {
                            if (modal) modal.style.display = 'none';
                        });
                    });
                    
                    // Close on background click
                    if (modal) {
                        modal.addEventListener('click', (e) => {
                            if (e.target === modal) {
                                modal.style.display = 'none';
                            }
                        });
                    }
                }
            }, 1000);
        });
    </script>
</x-app-layout>
