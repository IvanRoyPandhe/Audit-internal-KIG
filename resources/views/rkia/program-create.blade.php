<x-app-layout>
    <x-slot name="title">Buat Program Audit</x-slot>

    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('rkia.program') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Program
            </a>
            <h2 class="text-2xl font-bold text-gray-800 mt-4">Buat Program Audit</h2>
            <p class="text-sm text-gray-600 mt-1">Buat program audit untuk {{ $timeline->department->name }}</p>
        </div>

        <!-- Timeline Info -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg mb-6">
            <div class="flex">
                <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div class="text-sm text-blue-700">
                    <p class="font-semibold mb-1">Informasi Timeline:</p>
                    <ul class="space-y-1">
                        <li><strong>Departemen:</strong> {{ $timeline->department->name }} ({{ $timeline->department->code }})</li>
                        <li><strong>Periode:</strong> {{ $timeline->start_date->format('d M Y') }} - {{ $timeline->end_date->format('d M Y') }}</li>
                        @if($timeline->department->seniorManager)
                            <li><strong>Senior Manager:</strong> {{ $timeline->department->seniorManager->name }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow p-6">
            <form action="{{ route('audit-programs.store', $timeline) }}" method="POST">
                @csrf

                <div class="space-y-6">
                    <!-- Nama Program -->
                    <div>
                        <label for="program_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Program Audit <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="program_name" id="program_name" value="{{ old('program_name', 'Program Audit ' . $timeline->department->name . ' ' . $timeline->audit_year) }}" 
                            required
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('program_name') border-red-500 @enderror"
                            placeholder="Contoh: Program Audit Finance Q1 2025">
                        @error('program_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Nama program akan muncul di laporan audit</p>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi Program
                        </label>
                        <textarea name="description" id="description" rows="4" 
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                            placeholder="Deskripsi singkat tentang program audit ini...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info Box -->
                    <div class="bg-purple-50 border-l-4 border-purple-500 p-4 rounded">
                        <div class="flex">
                            <svg class="w-5 h-5 text-purple-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <div class="text-sm text-purple-700">
                                <p class="font-semibold mb-1">Langkah Selanjutnya:</p>
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Setelah program dibuat, Anda dapat menambahkan pertanyaan audit</li>
                                    <li>Pertanyaan dapat ditambahkan secara manual atau import dari Excel</li>
                                    <li>Program akan otomatis aktif setelah pertanyaan ditambahkan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end space-x-3 pt-6 border-t mt-6">
                    <a href="{{ route('rkia.program') }}" 
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                        Batal
                    </a>
                    <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Buat Program
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
