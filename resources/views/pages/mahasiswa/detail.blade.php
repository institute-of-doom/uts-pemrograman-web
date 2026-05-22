<x-app-layout>
    <x-slot:title>Detail Mahasiswa - {{ $mahasiswa->nama }}</x-slot:title>

    <div class="max-w-5xl mx-auto space-y-6">
        <!-- Notifikasi Sukses / Error -->
        @if(session('success'))
            <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded-r-xl text-green-700 text-sm font-semibold shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl text-red-700 text-sm shadow-sm">
                <p class="font-bold">Gagal menyimpan nilai:</p>
                <ul class="list-disc pl-5 mt-1">
                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <!-- Card Biodata Mahasiswa -->
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
                <p><span class="text-gray-500 font-medium inline-block w-28">KTM</span>:
                    <span class="bg-gray-100 px-2 py-0.5 rounded font-mono font-bold border">{{ $mahasiswa->kartuMahasiswa->no_kartu ?? 'Belum Cetak' }}</span>
                </p>
            </div>
        </div>

        <!-- Tabel Nilai Mata Kuliah -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Daftar Nilai Mata Kuliah</h3>
                <!-- Tombol membuka modal via JS Murni -->
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
                                <td class="p-4 font-mono font-bold text-indigo-600">{{ $mk->create_at ?? $mk->kode_matkul }}</td>
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

        <!-- MODAL POPUP (Default tersembunyi dengan class 'hidden') -->
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
                                    <option value="{{ $matkul->id }}">{{ $matkul->kode_matkul }} - {{ $matkul->nama_matkul }} ({{ $matkul->sks }} SKS)</option>
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

    <!-- Script Kontrol Vanilla JS Murni -->
    <script>
        function openModalMK() {
            document.getElementById('modalInputNilai').classList.remove('hidden');
        }

        function closeModalMK() {
            document.getElementById('modalInputNilai').classList.add('hidden');
        }
    </script>
</x-app-layout>
