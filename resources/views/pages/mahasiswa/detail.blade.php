<x-app-layout>
    <x-slot:title>Detail Mahasiswa - {{ $mahasiswa->nama }}</x-slot:title>

    <div class="max-w-5xl mx-auto space-y-6">
        @if(session('success'))
            <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded-r-xl text-green-700 text-sm font-semibold shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl text-red-700 text-sm shadow-sm">
                <p class="font-bold">Gagal memproses data:</p>
                <ul class="list-disc pl-5 mt-1">
                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl border border-gray-100 shadow-md overflow-hidden">
            <div class="bg-blue-600 px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-bold text-white">Biodata Mahasiswa</h3>
                <a href="{{ route('mahasiswa.list') }}" class="text-xs bg-white/20 text-white px-3 py-1.5 rounded-lg font-semibold hover:bg-white/30 transition">
                    &larr; Kembali ke List
                </a>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <p><span class="text-gray-500 font-medium inline-block w-28">NIM</span>: <strong>{{ $mahasiswa->nim }}</strong></p>
                <p><span class="text-gray-500 font-medium inline-block w-28">Nama</span>: <strong>{{ $mahasiswa->nama }}</strong></p>
                <p><span class="text-gray-500 font-medium inline-block w-28">Email</span>: {{ $mahasiswa->email }}</p>
                <p><span class="text-gray-500 font-medium inline-block w-28">Jurusan</span>: {{ $mahasiswa->jurusan->nama_jurusan ?? '-' }}</p>

                <div class="md:col-span-2 flex flex-wrap items-center justify-between bg-gray-50 p-3 rounded-xl border border-gray-100 mt-2">
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-500 font-bold uppercase tracking-wider text-xs">Status KTM :</span>
                        @if($mahasiswa->kartuMahasiswa)
                            <span class="bg-green-100 text-green-800 px-2.5 py-1 rounded-md font-mono font-bold border border-green-200 shadow-sm text-xs">
                                {{ $mahasiswa->kartuMahasiswa->no_kartu }}
                            </span>
                        @else
                            <span class="bg-yellow-100 text-yellow-800 px-2.5 py-1 rounded-md font-medium border border-yellow-200 text-xs">
                                Belum Memiliki Kartu
                            </span>
                        @endif
                    </div>

                    @if(!$mahasiswa->kartuMahasiswa)
                        <form action="{{ route('mahasiswa.generate_kartu', $mahasiswa->id) }}" method="POST" class="inline m-0">
                            @csrf
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm transition flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 00-2-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Generate Kartu (KTM)
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Daftar Nilai Mata Kuliah</h3>
                <button onclick="openModalMK()" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-3 py-2 rounded-lg shadow-sm transition">
                    + Input Nilai Mata Kuliah
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 font-bold border-b border-gray-200">
                            <th class="p-4">Kode MK</th>
                            <th class="p-4">Mata Kuliah</th>
                            <th class="p-4 text-center">SKS</th>
                            <th class="p-4 text-center">Nilai Pivot</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($mahasiswa->mataKuliah as $mk)
                            <tr class="hover:bg-gray-50/70 transition">
                                <td class="p-4 font-mono font-bold text-indigo-600">{{ $mk->kode_matkul }}</td>
                                <td class="p-4 font-medium text-gray-800">{{ $mk->nama_matkul }}</td>
                                <td class="p-4 text-center text-gray-600">{{ $mk->sks }}</td>
                                <td class="p-4 text-center">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-black px-2.5 py-1 rounded-md border border-blue-200 shadow-sm">
                                        {{ $mk->pivot->nilai }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-400 italic">Belum ada mata kuliah dan nilai yang diambil.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div id="modalInputNilai" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4">
            <div class="bg-white rounded-xl shadow-2xl border border-gray-100 max-w-md w-full overflow-hidden">
                <div class="bg-indigo-600 px-6 py-4 text-white flex justify-between items-center">
                    <h4 class="font-bold">Input Nilai Mata Kuliah</h4>
                    <button type="button" onclick="closeModalMK()" class="text-white/80 hover:text-white text-2xl font-bold">&times;</button>
                </div>

                <form action="{{ route('mahasiswa.add_nilai', $mahasiswa->id) }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Pilih Mata Kuliah</label>
                        <select name="matakuliah_id" required class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500">
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @if(isset($allMataKuliah) && count($allMataKuliah) > 0)
                                @foreach($allMataKuliah as $matkul)
                                    <option value="{{ $matkul->id }}">{{ $matkul->kode_matkul }} - {{ $matkul->nama_matkul }}</option>
                                @endforeach
                            @else
                                <option value="" disabled>Data Mata Kuliah Kosong / Belum Di-seed</option>
                            @endif
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Input Nilai Huruf / Angka</label>
                        <input type="text" name="nilai" required placeholder="Contoh: A, B+, 85" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500">
                    </div>

                    <div class="flex justify-end space-x-3 pt-3 border-t border-gray-100">
                        <button type="button" onclick="closeModalMK()" class="px-4 py-2 text-xs font-bold text-gray-500 hover:text-gray-700 transition">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-lg shadow-md transition">Simpan Nilai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModalMK() {
            document.getElementById('modalInputNilai').classList.remove('hidden');
        }

        function closeModalMK() {
            document.getElementById('modalInputNilai').classList.add('hidden');
        }
    </script>
</x-app-layout>
