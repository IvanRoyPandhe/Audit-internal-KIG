<x-app-layout>
    <x-slot name="title">Program Audit - {{ $program->program_name }}</x-slot>

    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <a href="{{ route('rkia.program') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Program
                    </a>
                    
                    <div class="flex items-center space-x-3 mb-2">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $program->program_name }}</h2>
                        @if($program->status === 'draft')
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">Draft</span>
                        @elseif($program->status === 'active')
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">Active</span>
                        @else
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">Completed</span>
                        @endif
                    </div>
                    
                    <p class="text-gray-600 mb-4">{{ $program->description }}</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs text-gray-600 mb-1">Departemen</p>
                            <p class="font-semibold text-gray-900">{{ $program->auditTimeline->department->name }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs text-gray-600 mb-1">Kode Program</p>
                            <p class="font-semibold text-gray-900">{{ $program->program_code }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs text-gray-600 mb-1">Periode</p>
                            <p class="font-semibold text-gray-900">{{ $program->start_date->format('d M') }} - {{ $program->end_date->format('d M Y') }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs text-gray-600 mb-1">Total Pertanyaan</p>
                            <p class="font-semibold text-gray-900">{{ $program->total_questions }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Tracking -->
        @if($program->total_questions > 0)
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Progress Audit</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                @php
                    $openCount = $program->auditQuestions->where('status', 'open')->count();
                    $inProgressCount = $program->auditQuestions->where('status', 'in_progress')->count();
                    $closedCount = $program->closed_questions;
                    $answeredCount = $program->answered_questions;
                    $progressPercentage = $program->total_questions > 0 ? round(($closedCount / $program->total_questions) * 100) : 0;
                @endphp
                
                <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-red-600 font-medium mb-1">Open</p>
                            <p class="text-2xl font-bold text-red-700">{{ $openCount }}</p>
                        </div>
                        <svg class="w-8 h-8 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-yellow-600 font-medium mb-1">In Progress</p>
                            <p class="text-2xl font-bold text-yellow-700">{{ $inProgressCount }}</p>
                        </div>
                        <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-green-600 font-medium mb-1">Closed</p>
                            <p class="text-2xl font-bold text-green-700">{{ $closedCount }}</p>
                        </div>
                        <svg class="w-8 h-8 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-blue-600 font-medium mb-1">Completion</p>
                            <p class="text-2xl font-bold text-blue-700">{{ $progressPercentage }}%</p>
                        </div>
                        <svg class="w-8 h-8 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="mb-2">
                <div class="flex items-center justify-between text-sm mb-1">
                    <span class="text-gray-600">Progress Keseluruhan</span>
                    <span class="font-semibold text-gray-900">{{ $closedCount }} / {{ $program->total_questions }} Pertanyaan</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-gradient-to-r from-blue-500 to-green-500 h-3 rounded-full transition-all duration-500" style="width: {{ $progressPercentage }}%"></div>
                </div>
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <button onclick="openAddQuestionModal()" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Pertanyaan Manual
                </button>

                <button class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    Import dari Excel
                </button>
            </div>

            <button class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Download Template Excel
            </button>
        </div>

        <!-- Filter & Search -->
        <div class="bg-white rounded-xl shadow p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <select id="statusFilter" class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">Semua Status</option>
                        <option value="open">Open</option>
                        <option value="in_progress">In Progress</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
                <div class="flex items-center space-x-2">
                    <input type="text" id="searchQuestion" placeholder="Cari pertanyaan..." class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>
            </div>
        </div>

        <!-- Questions List -->
        <div class="bg-white rounded-xl shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Pertanyaan Audit</h3>
                <p class="text-sm text-gray-600 mt-1">Kelola pertanyaan dan data yang dibutuhkan untuk audit</p>
            </div>

            <div class="p-6">
                @if($program->auditQuestions->count() > 0)
                    <div class="space-y-3">
                        @foreach($program->auditQuestions as $question)
                            <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="text-sm font-bold text-gray-700 bg-gray-100 px-2 py-1 rounded">#{{ $question->order_number }}</span>
                                            
                                            <!-- Status Badge -->
                                            @if($question->status === 'open')
                                                <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Open</span>
                                            @elseif($question->status === 'in_progress')
                                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">In Progress</span>
                                            @else
                                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Closed</span>
                                            @endif

                                            <!-- Answer Type Badge -->
                                            @if($question->answer_type === 'text')
                                                <span class="px-2 py-1 bg-blue-50 text-blue-700 text-xs font-medium rounded">Text</span>
                                            @elseif($question->answer_type === 'file')
                                                <span class="px-2 py-1 bg-purple-50 text-purple-700 text-xs font-medium rounded">File</span>
                                            @else
                                                <span class="px-2 py-1 bg-indigo-50 text-indigo-700 text-xs font-medium rounded">Text & File</span>
                                            @endif

                                            @if($question->is_required)
                                                <span class="px-2 py-1 bg-orange-50 text-orange-700 text-xs font-medium rounded">Wajib</span>
                                            @endif
                                        </div>
                                        
                                        <p class="text-gray-900 font-semibold text-base mb-1">{{ $question->question }}</p>
                                        
                                        @if($question->description)
                                            <p class="text-sm text-gray-600 mb-2">{{ $question->description }}</p>
                                        @endif

                                        @if($question->required_documents)
                                            <div class="flex items-start text-sm text-gray-600 mt-2">
                                                <svg class="w-4 h-4 mr-1 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"/>
                                                </svg>
                                                <span>Dokumen: {{ $question->required_documents }}</span>
                                            </div>
                                        @endif

                                        @if($question->due_date)
                                            <div class="flex items-center text-sm text-gray-600 mt-2">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                                </svg>
                                                <span>Due: {{ $question->due_date->format('d M Y') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                    <div class="flex items-center space-x-2">
                                        <!-- View Detail Button -->
                                        <a href="{{ route('audit-questions.show', $question) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-semibold rounded-lg hover:bg-blue-700">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Detail & Komentar
                                        </a>

                                        <!-- Update Status Dropdown -->
                                        <div class="relative inline-block text-left">
                                            <button onclick="toggleStatusDropdown({{ $question->id }})" class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-700 text-xs font-semibold rounded-lg hover:bg-gray-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                </svg>
                                                Update Status
                                            </button>
                                            <div id="statusDropdown{{ $question->id }}" class="hidden absolute left-0 mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                                                <div class="py-1">
                                                    <form action="{{ route('audit-questions.update-status', $question) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="open">
                                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700">
                                                            <span class="inline-block w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                                            Open
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('audit-questions.update-status', $question) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="in_progress">
                                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-700">
                                                            <span class="inline-block w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>
                                                            In Progress
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('audit-questions.update-status', $question) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="closed">
                                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">
                                                            <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                                            Closed
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-2">
                                        <!-- Edit Button -->
                                        <button onclick="openEditQuestionModal({{ $question->id }})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>

                                        <!-- Delete Button -->
                                        <form action="{{ route('audit-questions.destroy', $question) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pertanyaan ini?')">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Pertanyaan</h3>
                        <p class="text-gray-600 mb-6">Mulai dengan menambahkan pertanyaan audit atau import dari Excel</p>
                        <div class="flex items-center justify-center space-x-3">
                            <button onclick="openAddQuestionModal()" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Tambah Pertanyaan
                            </button>
                            <button class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
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
    </div>

    <!-- Modal: Add Question -->
    <div id="addQuestionModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-lg bg-white">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Tambah Pertanyaan Baru</h3>
                <button onclick="closeAddQuestionModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form action="{{ route('audit-questions.store', $program) }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pertanyaan <span class="text-red-500">*</span></label>
                        <textarea name="question" rows="3" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Masukkan pertanyaan audit..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi / Penjelasan</label>
                        <textarea name="description" rows="2" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Penjelasan tambahan (opsional)"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Jawaban <span class="text-red-500">*</span></label>
                            <select name="answer_type" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                <option value="text">Text</option>
                                <option value="file">File</option>
                                <option value="both">Text & File</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                            <input type="date" name="due_date" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dokumen yang Dibutuhkan</label>
                        <input type="text" name="required_documents" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: SOP, Laporan Keuangan, dll">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_required" value="1" id="is_required" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="is_required" class="ml-2 text-sm text-gray-700">Pertanyaan wajib dijawab</label>
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-3 mt-6 pt-4 border-t">
                    <button type="button" onclick="closeAddQuestionModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Simpan Pertanyaan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddQuestionModal() {
            document.getElementById('addQuestionModal').classList.remove('hidden');
        }

        function closeAddQuestionModal() {
            document.getElementById('addQuestionModal').classList.add('hidden');
        }

        function toggleStatusDropdown(questionId) {
            const dropdown = document.getElementById('statusDropdown' + questionId);
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('[id^="statusDropdown"]');
            dropdowns.forEach(dropdown => {
                if (!dropdown.classList.contains('hidden') && !event.target.closest('button')) {
                    dropdown.classList.add('hidden');
                }
            });
        });

        // Filter questions by status
        document.getElementById('statusFilter')?.addEventListener('change', function() {
            const status = this.value.toLowerCase();
            const questions = document.querySelectorAll('[class*="border border-gray-200"]');
            
            questions.forEach(question => {
                if (status === '') {
                    question.style.display = 'block';
                } else {
                    const statusBadge = question.querySelector('[class*="rounded-full"]');
                    if (statusBadge && statusBadge.textContent.toLowerCase().includes(status.replace('_', ' '))) {
                        question.style.display = 'block';
                    } else {
                        question.style.display = 'none';
                    }
                }
            });
        });

        // Search questions
        document.getElementById('searchQuestion')?.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const questions = document.querySelectorAll('[class*="border border-gray-200"]');
            
            questions.forEach(question => {
                const text = question.textContent.toLowerCase();
                question.style.display = text.includes(searchTerm) ? 'block' : 'none';
            });
        });
    </script>
</x-app-layout>
