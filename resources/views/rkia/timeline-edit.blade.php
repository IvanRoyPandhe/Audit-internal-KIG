<x-app-layout>
    <x-slot name="title">Edit Timeline Audit</x-slot>

    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('rkia.timeline') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Timeline
            </a>
            <h2 class="text-2xl font-bold text-gray-800 mt-4">Edit Timeline Audit</h2>
            <p class="text-sm text-gray-600 mt-1">Update jadwal audit untuk {{ $timeline->department->name }}</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow p-6">
            <form action="{{ route('rkia.timeline.update', $timeline) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Tahun Audit -->
                    <div>
                        <label for="audit_year" class="block text-sm font-medium text-gray-700 mb-2">
                            Tahun Audit <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="audit_year" id="audit_year" value="{{ old('audit_year', $timeline->audit_year) }}" 
                            min="2020" max="2100" required
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('audit_year') border-red-500 @enderror">
                        @error('audit_year')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Departemen -->
                    <div>
                        <label for="department_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Departemen <span class="text-red-500">*</span>
                        </label>
                        <select name="department_id" id="department_id" required
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('department_id') border-red-500 @enderror">
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id', $timeline->department_id) == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->code }} - {{ $dept->name }}
                                    @if($dept->seniorManager)
                                        (SM: {{ $dept->seniorManager->name }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Mulai -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Mulai <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $timeline->start_date->format('Y-m-d')) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('start_date') border-red-500 @enderror">
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Selesai -->
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Selesai <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $timeline->end_date->format('Y-m-d')) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('end_date') border-red-500 @enderror">
                        @error('end_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status Timeline <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status" required
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            <option value="scheduled" {{ old('status', $timeline->status) == 'scheduled' ? 'selected' : '' }}>Terjadwal</option>
                            <option value="ongoing" {{ old('status', $timeline->status) == 'ongoing' ? 'selected' : '' }}>Berjalan</option>
                            <option value="completed" {{ old('status', $timeline->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancelled" {{ old('status', $timeline->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <!-- Status Aktif -->
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $timeline->is_active) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Timeline Aktif (Departemen mendapat jadwal audit)</span>
                        </label>
                        <p class="mt-1 text-xs text-gray-500">Hanya timeline aktif yang akan muncul di Program Audit</p>
                    </div>

                    <!-- Catatan -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Catatan
                        </label>
                        <textarea name="notes" id="notes" rows="3" 
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('notes') border-red-500 @enderror"
                            placeholder="Catatan tambahan untuk timeline ini...">{{ old('notes', $timeline->notes) }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end space-x-3 pt-6 border-t mt-6">
                    <a href="{{ route('rkia.timeline') }}" 
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                        Batal
                    </a>
                    <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Timeline
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
