<x-app-layout>
    <x-slot name="title">Tambah Role</x-slot>

    <div class="bg-white rounded-2xl shadow-xl p-6 max-w-2xl">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Form Tambah Role</h3>

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Role (Kode)</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="contoh: auditor" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    <p class="text-xs text-gray-500 mt-1">Gunakan huruf kecil tanpa spasi</p>
                    @error('name')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Display Name</label>
                    <input type="text" name="display_name" value="{{ old('display_name') }}" placeholder="contoh: Auditor" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    @error('display_name')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                    @error('description')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Simpan</button>
                <a href="{{ route('roles.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
