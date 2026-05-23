<x-app-layout>
    <x-slot:title>
        Daftar Mahasiswa
    </x-slot:title>

    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 pb-6 border-b gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Daftar Mahasiswa</h2>
                <p class="text-blue-600 font-medium">Manajemen data akademik dan profil diri mahasiswa yang terdaftar.</p>
            </div>
            <div>
                <a href="{{ route('mahasiswa.form') }}"
                   class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-md hover:shadow-lg transition duration-200 text-sm tracking-wide">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Baru
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-xl text-sm text-green-700 flex items-start shadow-sm">
                <svg class="w-5 h-5 mr-3 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="flex flex-wrap gap-2 mb-6">
            <a href="{{ route('mahasiswa.list') }}"
               class="px-4 py-2 text-sm font-semibold rounded-lg border transition {{ !request('jurusan') ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-50' }}">
                Semua
            </a>
            <a href="{{ route('mahasiswa.list', ['jurusan' => 'TI']) }}"
               class="px-4 py-2 text-sm font-semibold rounded-lg border transition {{ request('jurusan') == 'TI' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-50' }}">
                TI
            </a>
            <a href="{{ route('mahasiswa.list', ['jurusan' => 'SI']) }}"
               class="px-4 py-2 text-sm font-semibold rounded-lg border transition {{ request('jurusan') == 'SI' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-50' }}">
                SI
            </a>
            <a href="{{ route('mahasiswa.list', ['jurusan' => 'MI']) }}"
               class="px-4 py-2 text-sm font-semibold rounded-lg border transition {{ request('jurusan') == 'MI' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-50' }}">
                MI
            </a>
            <a href="{{ route('mahasiswa.statistik') }}"
               class="px-4 py-2 text-sm font-semibold rounded-lg border">
                STATISTIK
            </a>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-md overflow-hidden">
            <div class="bg-blue-600 px-6 py-4">
                <h3 class="text-lg font-bold text-white">Database Mahasiswa</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider w-16 text-center">No</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider w-32">NIM</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Jurusan</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">No Kartu</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center w-28">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                        @forelse ($mahasiswas as $index => $mahasiswa)
                            <tr class="hover:bg-blue-50/40 transition">
                                <td class="px-6 py-4 text-center font-medium text-gray-500">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 tracking-wide">
                                    {{ $mahasiswa->nim }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $mahasiswa->nama }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-2.5 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-800 border border-blue-100">
                                        {{ $mahasiswa->jurusan->nama_jurusan ?? 'Tidak Diketahui' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-600 font-mono text-xs">
                                    {{ $mahasiswa->kartuMahasiswa->no_kartu ?? 'Belum Ada Kartu' }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2.5 max-w-md">
                                        @forelse($mahasiswa->mataKuliah as $mk)
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                                <span class="font-semibold">{{ $mk->nama_matkul }}</span>
                                                <span class="px-1.5 py-0.5 rounded-full bg-blue-600 text-white font-bold text-[10px]">
                                                    {{ $mk->pivot->nilai ?? $mk->nilai }}
                                                </span>
                                            </span>
                                        @empty
                                            <span class="text-xs text-gray-400 italic">Belum mengambil kelas</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('mahasiswa.detail', $mahasiswa->id) }}"
                                       class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-bold text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md transition duration-150 border border-blue-200 shadow-sm">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0V9a2 2 0 00-2-2H6a2 2 0 00-2 2v4.5m12+3.5h.01M16.318 13.068l-3.535 3.536L10 13.828l-1.414 1.414 3.536 3.536 4.243-4.242z"/>
                                    </svg>
                                    <p class="font-medium text-base mb-1">Belum ada data mahasiswa</p>
                                    <p class="text-xs">Gunakan tombol "Tambah Baru" di atas untuk memasukkan data atau ubah filter Anda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
