<x-app-layout>
    <x-slot name="title">Laporan Audit</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow p-4">
            <div class="text-sm text-gray-600">Total Laporan</div>
            <div class="text-2xl font-bold text-gray-800">24</div>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <div class="text-sm text-gray-600">Selesai</div>
            <div class="text-2xl font-bold text-green-600">18</div>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <div class="text-sm text-gray-600">Dalam Proses</div>
            <div class="text-2xl font-bold text-yellow-600">4</div>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <div class="text-sm text-gray-600">Tertunda</div>
            <div class="text-2xl font-bold text-red-600">2</div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-800">Daftar Laporan Audit</h3>
            <div class="flex gap-3">
                <input type="text" placeholder="Cari laporan..." class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"/>
                    </svg>
                    Buat Laporan
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach([
                ['Laporan Audit Keuangan Q1 2025', 'Keuangan', '15 Maret 2025', 'Selesai', 'green'],
                ['Laporan Audit Operasional', 'Operasional', '20 April 2025', 'Dalam Proses', 'yellow'],
                ['Laporan Audit IT Security', 'IT', '10 Mei 2025', 'Selesai', 'green'],
                ['Laporan Audit Kepatuhan', 'Compliance', '25 Mei 2025', 'Tertunda', 'red'],
                ['Laporan Audit SDM', 'SDM', '5 Juni 2025', 'Dalam Proses', 'yellow'],
                ['Laporan Audit Procurement', 'Procurement', '15 Juni 2025', 'Selesai', 'green']
            ] as $laporan)
            <div class="border border-gray-200 rounded-xl p-4 hover:shadow-lg transition">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="px-2 py-1 bg-{{ $laporan[4] }}-100 text-{{ $laporan[4] }}-700 text-xs font-semibold rounded-full">
                        {{ $laporan[3] }}
                    </span>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">{{ $laporan[0] }}</h4>
                <div class="flex items-center text-sm text-gray-600 mb-1">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                    {{ $laporan[2] }}
                </div>
                <div class="flex items-center text-sm text-gray-600 mb-3">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                    </svg>
                    {{ $laporan[1] }}
                </div>
                <div class="flex gap-2">
                    <button class="flex-1 px-3 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">Lihat</button>
                    <button class="px-3 py-2 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                        </svg>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
