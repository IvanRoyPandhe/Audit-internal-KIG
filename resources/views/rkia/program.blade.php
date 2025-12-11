<x-app-layout>
    <x-slot name="title">Program Audit</x-slot>

    <div class="space-y-6">
        <!-- Header dengan Instruksi -->
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Program Audit - RKIA</h2>
                    <p class="text-gray-600 mb-4">Buat program audit dengan menginput pertanyaan dan data yang dibutuhkan untuk setiap departemen yang sudah dijadwalkan.</p>
                    
                    <!-- Workflow Info -->
                    <div class="bg-purple-50 border-l-4 border-purple-500 p-4 rounded mt-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-purple-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <div class="text-sm text-purple-700">
                                <p class="font-semibold mb-1">Langkah 2: Buat Program Audit</p>
                                <ul class="list-disc list-inside space-y-1 text-purple-600">
                                    <li>Pilih departemen dari timeline yang sudah aktif</li>
                                    <li>Input pertanyaan audit secara manual atau import dari Excel</li>
                                    <li>Tentukan tipe jawaban: Text, File, atau Both</li>
                                    <li>Set pertanyaan wajib dan dokumen yang dibutuhkan</li>
                                    <li>Setelah program dibuat, auditee dapat mulai mengerjakan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Departemen dengan Timeline Aktif -->
        <div class="bg-white rounded-xl shadow">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Departemen dengan Jadwal Audit Tahun {{ $year }}</h3>
                        <p class="text-sm text-gray-600 mt-1">Pilih departemen untuk membuat atau mengelola program audit</p>
                    </div>
                    <form method="GET" action="{{ route('rkia.program') }}">
                        <select name="year" onchange="this.form.submit()" class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            @php
                                $years = range(date('Y'), date('Y') - 5);
                            @endphp
                            @foreach($years as $y)
                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            <div class="p-6">
                @if($programs->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($programs as $timeline)
                            @php
                                $programCount = $timeline->auditPrograms->count();
                                $hasProgram = $programCount > 0;
                            @endphp
                            
                            @php
                                $program = $hasProgram ? $timeline->auditPrograms->first() : null;
                                $totalQuestions = $program ? $program->total_questions : 0;
                            @endphp
                            
                            <a href="{{ $hasProgram ? route('audit-programs.show', $program) : route('audit-programs.create', $timeline) }}" 
                               class="block border-2 {{ $hasProgram ? 'border-green-500 bg-green-50' : 'border-gray-200' }} rounded-xl p-6 hover:shadow-lg hover:scale-105 transition cursor-pointer">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-lg">{{ $timeline->department->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $timeline->department->code }}</p>
                                    </div>
                                    @if($hasProgram)
                                        @if($program->status === 'draft')
                                            <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">Draft</span>
                                        @elseif($program->status === 'active')
                                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Active</span>
                                        @else
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Completed</span>
                                        @endif
                                    @else
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Belum Ada Program</span>
                                    @endif
                                </div>
                                
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $timeline->start_date->format('d M Y') }} - {{ $timeline->end_date->format('d M Y') }}
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $totalQuestions }} Pertanyaan
                                    </div>
                                    @if($timeline->department->seniorManager)
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                            </svg>
                                            SM: {{ $timeline->department->seniorManager->name }}
                                        </div>
                                    @endif
                                </div>

                                <div class="flex items-center justify-center pt-3 border-t border-gray-200">
                                    @if($hasProgram)
                                        <span class="text-sm font-semibold text-green-600">Klik untuk kelola program →</span>
                                    @else
                                        <span class="text-sm font-semibold text-blue-600">Klik untuk buat program →</span>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State - Belum ada timeline -->
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Departemen Terjadwal</h3>
                        <p class="text-gray-600 mb-6">Buat timeline audit terlebih dahulu di menu Timeline</p>
                        <a href="{{ route('rkia.timeline') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Ke Timeline Audit
                        </a>
                    </div>
                @endif

                <!-- Example Department Cards (akan diisi dengan data real) -->
                <!--
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-blue-500 hover:shadow-lg transition cursor-pointer">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg">Finance</h4>
                                <p class="text-sm text-gray-600">FIN</p>
                            </div>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Draft</span>
                        </div>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                15 Jan - 28 Feb 2025
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                </svg>
                                0 Pertanyaan
                            </div>
                        </div>

                        <div class="flex items-center space-x-2">
                            <button class="flex-1 px-3 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700">
                                Buat Program
                            </button>
                            <button class="px-3 py-2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="border-2 border-green-500 rounded-xl p-6 hover:shadow-lg transition cursor-pointer bg-green-50">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg">IT Department</h4>
                                <p class="text-sm text-gray-600">IT</p>
                            </div>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Active</span>
                        </div>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                1 Mar - 15 Apr 2025
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                </svg>
                                25 Pertanyaan
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                15 Terjawab
                            </div>
                        </div>

                        <div class="flex items-center space-x-2">
                            <button class="flex-1 px-3 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700">
                                Kelola Program
                            </button>
                            <button class="px-3 py-2 bg-white text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-50 border border-gray-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                -->
            </div>
        </div>

        <!-- Info Box -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                <div class="flex">
                    <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div class="text-sm text-blue-700">
                        <p class="font-semibold mb-1">Cara Input Pertanyaan:</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li><strong>Manual:</strong> Input pertanyaan satu per satu</li>
                            <li><strong>Import Excel:</strong> Upload file dengan template</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
                <div class="flex">
                    <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div class="text-sm text-green-700">
                        <p class="font-semibold mb-1">Status Pertanyaan:</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li><strong>Open:</strong> Belum dijawab</li>
                            <li><strong>In Progress:</strong> Sedang diproses/revisi</li>
                            <li><strong>Closed:</strong> Sudah selesai</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
