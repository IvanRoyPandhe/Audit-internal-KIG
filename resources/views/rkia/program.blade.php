<x-app-layout>
    <x-slot name="title">Program RKIA</x-slot>

    <div class="bg-white rounded-2xl shadow-xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-800">Program Audit 2025</h3>
            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"/>
                </svg>
                Tambah Program
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama Program</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Area Audit</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Periode</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach([
                        ['Audit Keuangan Q1', 'Keuangan', 'Jan - Mar 2025', 'Selesai', 'green'],
                        ['Audit Operasional', 'Operasional', 'Apr - Jun 2025', 'Berjalan', 'yellow'],
                        ['Audit IT', 'Teknologi Informasi', 'Jul - Sep 2025', 'Dijadwalkan', 'blue'],
                        ['Audit Kepatuhan', 'Compliance', 'Oct - Dec 2025', 'Dijadwalkan', 'blue']
                    ] as $index => $program)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $program[0] }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $program[1] }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $program[2] }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-{{ $program[4] }}-100 text-{{ $program[4] }}-700 text-xs font-semibold rounded-full">
                                {{ $program[3] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <button class="text-blue-600 hover:text-blue-800 mr-3">Edit</button>
                            <button class="text-red-600 hover:text-red-800">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
