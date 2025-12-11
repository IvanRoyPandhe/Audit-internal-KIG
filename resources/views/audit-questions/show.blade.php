<x-app-layout>
    <x-slot name="title">Detail Pertanyaan - {{ $question->question }}</x-slot>

    <div class="space-y-6">
        <!-- Breadcrumb -->
        <div class="flex items-center text-sm text-gray-600">
            <a href="{{ route('rkia.program') }}" class="hover:text-gray-900">Program</a>
            <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <a href="{{ route('audit-programs.show', $question->auditProgram) }}" class="hover:text-gray-900">{{ $question->auditProgram->program_name }}</a>
            <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-900">Pertanyaan #{{ $question->order_number }}</span>
        </div>

        <!-- Question Detail -->
        <div class="bg-white rounded-xl shadow">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-3">
                            <span class="text-sm font-bold text-gray-700 bg-gray-100 px-3 py-1 rounded">#{{ $question->order_number }}</span>
                            
                            @if($question->status === 'open')
                                <span class="px-3 py-1 bg-red-100 text-red-800 text-sm font-semibold rounded-full">Open</span>
                            @elseif($question->status === 'in_progress')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-semibold rounded-full">In Progress</span>
                            @else
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full">Closed</span>
                            @endif

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

                        <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $question->question }}</h2>
                        
                        @if($question->description)
                            <p class="text-gray-600 mb-4">{{ $question->description }}</p>
                        @endif
                    </div>

                    <button onclick="openEditModal()" class="ml-4 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Departemen</p>
                        <p class="font-semibold text-gray-900">{{ $question->auditProgram->auditTimeline->department->name }}</p>
                    </div>
                    
                    @if($question->required_documents)
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Dokumen Dibutuhkan</p>
                        <p class="font-semibold text-gray-900">{{ $question->required_documents }}</p>
                    </div>
                    @endif

                    @if($question->due_date)
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Due Date</p>
                        <p class="font-semibold text-gray-900">{{ $question->due_date->format('d M Y') }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Update Status Section -->
            <div class="p-6 bg-gray-50 border-b border-gray-200">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Update Status Pertanyaan</h3>
                <div class="flex items-center space-x-3">
                    <form action="{{ route('audit-questions.update-status', $question) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="open">
                        <button type="submit" class="px-4 py-2 bg-red-100 text-red-700 text-sm font-semibold rounded-lg hover:bg-red-200 {{ $question->status === 'open' ? 'ring-2 ring-red-500' : '' }}">
                            Open
                        </button>
                    </form>

                    <form action="{{ route('audit-questions.update-status', $question) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="in_progress">
                        <button type="submit" class="px-4 py-2 bg-yellow-100 text-yellow-700 text-sm font-semibold rounded-lg hover:bg-yellow-200 {{ $question->status === 'in_progress' ? 'ring-2 ring-yellow-500' : '' }}">
                            In Progress
                        </button>
                    </form>

                    <form action="{{ route('audit-questions.update-status', $question) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="closed">
                        <button type="submit" class="px-4 py-2 bg-green-100 text-green-700 text-sm font-semibold rounded-lg hover:bg-green-200 {{ $question->status === 'closed' ? 'ring-2 ring-green-500' : '' }}">
                            Closed
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Answers Section -->
        <div class="bg-white rounded-xl shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Jawaban</h3>
            </div>
            <div class="p-6">
                @if($question->auditAnswers->count() > 0)
                    <div class="space-y-4">
                        @foreach($question->auditAnswers as $answer)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                                            {{ substr($answer->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $answer->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $answer->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    @if($answer->status)
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded">{{ ucfirst($answer->status) }}</span>
                                    @endif
                                </div>
                                
                                @if($answer->answer_text)
                                    <p class="text-gray-700 mb-2">{{ $answer->answer_text }}</p>
                                @endif

                                @if($answer->documents && $answer->documents->count() > 0)
                                    <div class="mt-3">
                                        <p class="text-sm font-medium text-gray-700 mb-2">Dokumen:</p>
                                        <div class="space-y-2">
                                            @foreach($answer->documents as $doc)
                                                <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="flex items-center text-sm text-blue-600 hover:text-blue-800">
                                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $doc->file_name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                        <p>Belum ada jawaban</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-white rounded-xl shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Komentar & Diskusi</h3>
                <p class="text-sm text-gray-600 mt-1">Diskusikan pertanyaan ini dengan tim audit</p>
            </div>

            <div class="p-6">
                <!-- Add Comment Form -->
                <form action="{{ route('audit-questions.add-comment', $question) }}" method="POST" class="mb-6">
                    @csrf
                    <div class="mb-3">
                        <textarea name="comment" rows="3" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Tulis komentar..."></textarea>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_internal" value="1" id="is_internal" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label for="is_internal" class="ml-2 text-sm text-gray-700">Komentar internal (hanya auditor)</label>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700">
                            Kirim Komentar
                        </button>
                    </div>
                </form>

                <!-- Comments List -->
                @if($question->comments->count() > 0)
                    <div class="space-y-4">
                        @foreach($question->comments as $comment)
                            <div class="border-l-4 {{ $comment->is_internal ? 'border-orange-500 bg-orange-50' : 'border-blue-500 bg-blue-50' }} rounded-r-lg p-4">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gray-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                            {{ substr($comment->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $comment->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                        @if($comment->is_internal)
                                            <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs font-medium rounded">Internal</span>
                                        @endif
                                    </div>
                                    
                                    @if($comment->user_id === auth()->id() || auth()->user()->hasRole('admin'))
                                        <form action="{{ route('audit-questions.delete-comment', $comment) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <p class="text-gray-700">{{ $comment->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <p>Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
