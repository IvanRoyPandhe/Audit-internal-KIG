<x-app-layout>
    <x-slot name="title">Tambah Departemen</x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('departments.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Departemen
                </a>
                <h2 class="text-2xl font-bold text-gray-800 mt-4">Tambah Departemen Baru</h2>
                <p class="text-sm text-gray-600 mt-1">Isi form di bawah untuk menambahkan departemen baru</p>
            </div>

            <!-- Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('departments.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <!-- Kode Departemen -->
                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Departemen <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="code" id="code" value="{{ old('code') }}" 
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('code') border-red-500 @enderror"
                            placeholder="Contoh: FIN, IT, HR" required>
                        @error('code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Kode unik untuk departemen (maksimal 20 karakter)</p>
                    </div>

                    <!-- Nama Departemen -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Departemen <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                            placeholder="Contoh: Finance, Information Technology" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea name="description" id="description" rows="4" 
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                            placeholder="Deskripsi singkat tentang departemen ini...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Senior Manager -->
                    <div>
                        <label for="sm_user_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Senior Manager (SM)
                        </label>
                        <select name="sm_user_id" id="sm_user_id" 
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('sm_user_id') border-red-500 @enderror">
                            <option value="">-- Pilih Senior Manager --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('sm_user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }}) - {{ $user->role->display_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('sm_user_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">SM akan menerima notifikasi email saat departemen mendapat jadwal audit</p>
                    </div>

                    <!-- Status Aktif -->
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Departemen Aktif</span>
                        </label>
                        <p class="mt-1 text-xs text-gray-500">Hanya departemen aktif yang bisa dijadwalkan untuk audit</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-end space-x-3 pt-6 border-t">
                        <a href="{{ route('departments.index') }}" 
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                            Batal
                        </a>
                        <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Departemen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
