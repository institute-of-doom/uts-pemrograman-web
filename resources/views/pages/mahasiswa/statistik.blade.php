<x-app-layout>
    <x-slot:title>
        Statistik Mahasiswa per Jurusan
    </x-slot:title>

    <div class="max-w-6xl mx-auto">
        <!-- Header Halaman -->
        <div class="mb-8 pb-6 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Statistik Akademik</h2>
                <p class="text-blue-600 font-medium mt-1">Ikhtisar total persebaran data mahasiswa aktif per program studi.</p>
            </div>
            <a href="{{ route('mahasiswa.list') }}" class="text-sm font-semibold text-blue-600 hover:underline flex items-center">
                &larr; Lihat List Mahasiswa
            </a>
        </div>

        <!-- Grid Container Card (Poin 3) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($jurusans as $jurusan)
                <!-- Card Item dengan Shadow & Border Rapi -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition duration-200 overflow-hidden flex flex-col justify-between">

                    <!-- Header Card Berwarna Cerah -->
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-5 text-white">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-widest bg-white/20 px-2.5 py-0.5 rounded-full">
                                Kode: {{ $jurusan->kode_jurusan }}
                            </span>
                            <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mt-3 tracking-wide truncate">
                            {{ $jurusan->nama_jurusan }}
                        </h3>
                    </div>

                    <!-- Body Card Menampilkan Jumlah Mahasiswa -->
                    <div class="p-6 bg-white flex flex-col items-center justify-center border-t border-gray-50">
                        <span class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Mahasiswa</span>
                        <!-- Mengakses atribut hasil dari withCount() -->
                        <span class="text-5xl font-black text-gray-800 tracking-tight">
                            {{ $jurusan->mahasiswas_count }}
                        </span>
                        <span class="text-xs text-gray-500 font-medium mt-2">Orang terdaftar</span>
                    </div>

                    <!-- Footer Card Aksi Sederhana -->
                    <div class="px-5 py-3.5 bg-gray-50 border-t border-gray-100 flex items-center justify-between text-xs">
                        <span class="text-gray-400 font-medium">Sistem Informasi Akademik</span>
                        <a href="{{ route('mahasiswa.list', ['jurusan' => $jurusan->kode_jurusan]) }}" class="font-bold text-indigo-600 hover:text-indigo-800 transition">
                            Filter List &rarr;
                        </a>
                    </div>
                </div>
            @empty
                <!-- Tampilan jika master jurusan belum di-seed -->
                <div class="col-span-full bg-yellow-50 border border-yellow-200 rounded-xl p-6 text-center text-sm text-yellow-700">
                    <p class="font-bold">Data Master Jurusan Belum Tersedia!</p>
                    <p class="mt-1">Silakan jalankan perintah <code class="bg-white px-1.5 py-0.5 rounded border text-red-600 font-mono text-xs">php artisan db:seed</code> terlebih dahulu di terminal.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
