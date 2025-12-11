<x-app-layout>
    <x-slot name="title">Detail Departemen</x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('departments.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Departemen
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Department Info -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Departemen</h3>
                            <a href="{{ route('departments.edit', $department) }}" class="text-blue-600 hover:text-blue-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase">Kode</label>
                                <p class="mt-1 text-sm font-semibold text-gray-900">{{ $department->code }}</p>
                            </div>

                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase">Nama Departemen</label>
                                <p class="mt-1 text-sm font-semibold text-gray-900">{{ $department->name }}</p>
                            </div>

                            @if($department->description)
                                <div>
                                    <label class="text-xs font-medium text-gray-500 uppercase">Deskripsi</label>
                                    <p class="mt-1 text-sm text-gray-700">{{ $department->description }}</p>
                                </div>
                            @endif

                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase">Status</label>
                                <div class="mt-1">
                                    @if($department->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase">Senior Manager</label>
                                @if($department->seniorManager)
                                    <div class="mt-2 flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                            <span class="text-blue-600 font-semibold">{{ substr($department->seniorManager->name, 0, 2) }}</span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $department->seniorManager->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $department->seniorManager->email }}</p>
                                        </div>
                                    </div>
                                @else
                                    <p class="mt-1 text-sm text-gray-400 italic">Belum ditentukan</p>
                                @endif
                            </div>

                            <div class="pt-4 border-t">
                                <label class="text-xs font-medium text-gray-500 uppercase">Dibuat</label>
                                <p class="mt-1 text-sm text-gray-700">{{ $department->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Users List -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Daftar User</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ $department->users->count() }} user di departemen ini</p>
                                </div>
                            </div>

                            @if($department->users->count() > 0)
                                <div class="space-y-3">
                                    @foreach($department->users as $user)
                                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <span class="text-blue-600 font-semibold text-sm">{{ substr($user->name, 0, 2) }}</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="flex items-center">
                                                        <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                                        @if($user->is_department_head)
                                                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                                SM
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="flex items-center space-x-2 mt-1">
                                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                                        <span class="text-gray-300">•</span>
                                                        <p class="text-xs text-gray-500">{{ $user->role->display_name }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                @if($user->is_active)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Aktif
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        Tidak Aktif
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada user</h3>
                                    <p class="mt-1 text-sm text-gray-500">User dapat ditambahkan melalui halaman User Management</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
