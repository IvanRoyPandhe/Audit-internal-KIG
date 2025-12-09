<x-app-layout>
    <x-slot name="title">Timeline RKIA</x-slot>

    <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-800">Timeline Rencana Kerja Internal Audit 2025</h3>
            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"/>
                </svg>
                Tambah Timeline
            </button>
        </div>

        <div class="relative">
            <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-blue-200"></div>
            
            @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $index => $bulan)
            <div class="relative pl-20 pb-8">
                <div class="absolute left-6 w-5 h-5 bg-blue-600 rounded-full border-4 border-white shadow"></div>
                <div class="bg-gray-50 rounded-lg p-4 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-bold text-gray-800">{{ $bulan }} 2025</h4>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">{{ $index + 1 }} Audit</span>
                    </div>
                    <p class="text-sm text-gray-600">Audit Keuangan, Audit Operasional</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
