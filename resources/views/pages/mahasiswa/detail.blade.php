<x-app-layout>
    <x-slot:title>
        Detail Mahasiswa - {{ $mahasiswa->nama }}
    </x-slot:title>

    <div class="max-w-5xl mx-auto space-y-8">

        <!-- Poin 3: Tombol Kembali ke Halaman List Mahasiswa -->
        <div class="flex items-center justify-between">
            <a href="{{ route('mahasiswa.list') }}"
               class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 rounded-lg border border-gray-200 shadow-sm transition duration-150">
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar
            </a>
            <span class="text-xs font-mono bg-blue-50 text-blue-700 px-3 py-1 rounded-full font-semibold">
                Status: Aktif
            </span>
        </div>

        <!-- Poin 1: Biodata Mahasiswa -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-md overflow-hidden">
            <div class="bg-blue-600 px-6 py-4">
                <h3 class="text-lg font-bold text-white">Biodata Mahasiswa</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                <div class="flex pb-3 border-b border-gray-50">
                    <span class="text-gray-500 w-36 font-medium">NIM</span>
                    <span class="text-gray-900 font-semibold">: {{ $mahasiswa->nim }}</span>
                </div>
                <div class="flex pb-3 border-b border-gray-50">
                    <span class="text-gray-500 w-36 font-medium">Nama Lengkap</span>
                    <span class="text-gray-900 font-semibold">: {{ $mahasiswa->nama }}</span>
                </div>
                <div class="flex pb-3 border-b border-gray-50">
                    <span class="text-gray-500 w-36 font-medium">Email</span>
                    <span class="text-gray-900">: {{ $mahasiswa->email }}</span>
                </div>
                <div class="flex pb-3 border-b border-gray-50">
                    <span class="text-gray-500 w-36 font-medium">Jenis Kelamin</span>
                    <span class="text-gray-900">: {{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                </div>
                <div class="flex pb-3 border-b border-gray-50 md:col-span-2">
                    <span class="text-gray-500 w-36 font-medium flex-shrink-0">Alamat</span>
                    <span class="text-gray-900">: {{ $mahasiswa->alamat }}</span>
                </div>
                <div class="flex pb-3 border-b border-gray-50">
                    <span class="text-gray-500 w-36 font-medium">Jurusan</span>
                    <span class="text-gray-900 font-semibold">: {{ $mahasiswa->jurusan->nama_jurusan ?? '-' }} ({{ $mahasiswa->jurusan->kode_jurusan ?? '-' }})</span>
                </div>
                <div class="flex pb-3 border-b border-gray-50">
                    <span class="text-gray-500 w-36 font-medium">No Kartu (KTM)</span>
                    <span class="text-gray-900 font-mono text-xs font-bold bg-gray-50 px-2 py-0.5 rounded border">
                        : {{ $mahasiswa->kartuMahasiswa->no_kartu ?? 'Belum Cetak Kartu' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Poin 2 & 4: Tabel Nilai Mata Kuliah dari Relasi Eloquent -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-md overflow-hidden">
            <div class="bg-gray-800 px-6 py-4">
                <h3 class="text-lg font-bold text-white">Kartu Hasil Studi (KHS)</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <th class="px-6 py-4 w-32">Kode MK</th>
                            <th class="px-6 py-4">Mata Kuliah</th>
                            <th class="px-6 py-4 w-24 text-center">SKS</th>
                            <th class="px-6 py-4 w-28 text-center">Nilai</th>
                            <th class="px-6 py-4 w-32 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                        @forelse($mahasiswa->mataKuliah as $mk)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-6 py-4 font-mono text-xs font-semibold text-gray-600">
                                    {{ $mk->kode_matkul ?? 'MK001' }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $mk->nama_matkul }}
                                </td>
                                <td class="px-6 py-4 text-center text-gray-600">
                                    {{ $mk->sks ?? '3' }} <!-- Jika di tabel mata_kuliahs kamu ada kolom sks -->
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                        {{ $mk->pivot->nilai ?? 'Belum Ada' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button type="button" class="text-xs font-bold text-red-600 hover:text-red-800 hover:underline">
                                        Drop Kelas
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-400 italic">
                                    Belum mengambil atau menginput nilai mata kuliah untuk mahasiswa ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
