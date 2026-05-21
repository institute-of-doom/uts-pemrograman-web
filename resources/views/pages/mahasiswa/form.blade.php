<x-app-layout>
    <x-slot:title>
        Tambah Mahasiswa
    </x-slot:title>

    <div class="max-w-4xl mx-auto">
        <div class="mb-8 pb-6 border-b">
            <h2 class="text-3xl font-bold text-gray-900">Form Tambah Mahasiswa</h2>
            <p class="text-blue-600 font-medium">Silakan isi data akademik dan data diri mahasiswa secara lengkap.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl text-sm text-red-700">
                <p class="font-bold mb-1">Peksa kembali inputan Anda:</p>
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl border border-gray-100 shadow-md overflow-hidden">
            <div class="bg-blue-600 px-6 py-4">
                <h3 class="text-lg font-bold text-white">Data Mahasiswa Baru</h3>
            </div>

            <form action="{{ route('mahasiswa.proses') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">NIM</label>
                        <input type="text" name="nim" value="{{ old('nim') }}"
                               class="w-full px-4 py-2 border @error('nim') border-red-400 focus:ring-red-100 @else border-gray-200 focus:ring-blue-100 focus:border-blue-500 @enderror rounded-lg focus:outline-none focus:ring-2 transition text-gray-800"
                               placeholder="Contoh: 21010123">
                        @error('nim')
                            <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama') }}"
                               class="w-full px-4 py-2 border @error('nama') border-red-400 focus:ring-red-100 @else border-gray-200 focus:ring-blue-100 focus:border-blue-500 @enderror rounded-lg focus:outline-none focus:ring-2 transition text-gray-800"
                               placeholder="Contoh: Alex Utama">
                        @error('nama')
                            <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full px-4 py-2 border @error('email') border-red-400 focus:ring-red-100 @else border-gray-200 focus:ring-blue-100 focus:border-blue-500 @enderror rounded-lg focus:outline-none focus:ring-2 transition text-gray-800"
                               placeholder="alex@mahasiswa.ac.id">
                        @error('email')
                            <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Jurusan</label>
                        <select name="jurusan_id"
                                    class="w-full px-4 py-2 border @error('jurusan_id') border-red-400 focus:ring-red-100 @else border-gray-200 focus:ring-blue-100 focus:border-blue-500 @enderror rounded-lg focus:outline-none focus:ring-2 transition text-gray-800 bg-white">
                                <option value="">-- Pilih Jurusan --</option>

                                <!-- 2. Ganti value menjadi ID Angka (1, 2, 3) sesuai database yang sudah di-seed -->
                                <option value="1" {{ old('jurusan_id') == '1' ? 'selected' : '' }}>Teknik Informatika (TI)</option>
                                <option value="2" {{ old('jurusan_id') == '2' ? 'selected' : '' }}>Sistem Informasi (SI)</option>
                                <option value="3" {{ old('jurusan_id') == '3' ? 'selected' : '' }}>Manajemen Informatika (MI)</option>
                            </select>

                            @error('jurusan_id')
                                <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Jenis Kelamin</label>
                        <div class="flex items-center space-x-6 py-2">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} class="form-radio text-blue-600 focus:ring-blue-500 h-4 w-4">
                                <span class="ml-2 text-gray-700 font-medium">Laki-laki</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }} class="form-radio text-blue-600 focus:ring-blue-500 h-4 w-4">
                                <span class="ml-2 text-gray-700 font-medium">Perempuan</span>
                            </label>
                        </div>
                        @error('jenis_kelamin')
                            <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Alamat</label>
                    <textarea name="alamat" rows="3"
                              class="w-full px-4 py-2 border @error('alamat') border-red-400 focus:ring-red-100 @else border-gray-200 focus:ring-blue-100 focus:border-blue-500 @enderror rounded-lg focus:outline-none focus:ring-2 transition text-gray-800"
                              placeholder="Tulis alamat lengkap rumah saat ini...">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2.5 rounded-lg shadow-md hover:shadow-lg transition duration-200 text-sm tracking-wide">
                        Simpan Mahasiswa
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
