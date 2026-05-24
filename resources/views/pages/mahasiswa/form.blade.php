<x-app-layout>
    <x-slot:title>
        Tambah Mahasiswa
    </x-slot:title>

    <div class="max-w-4xl mx-auto my-8 px-4">
        <div class="mb-8 pb-6 border-b border-slate-200">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Form Tambah Mahasiswa</h2>
            <p class="text-slate-500 mt-1">Silakan isi data akademik dan data diri mahasiswa secara lengkap.</p>
        </div>

        @if ($errors->any())
            <div class="mb-8 p-4 bg-rose-50 border-l-4 border-rose-500 rounded-r-2xl text-sm text-rose-900 shadow-sm flex items-start gap-3">
                <svg class="w-5 h-5 text-rose-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div>
                    <p class="font-bold text-rose-800 mb-1">Periksa kembali inputan Anda:</p>
                    <ul class="list-disc pl-5 space-y-1 text-rose-700 font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-slate-100 shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-700 to-indigo-800 px-6 py-5 relative">
                <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:12px_12px]"></div>
                <div class="relative z-10 flex items-center gap-2.5">
                    <div class="p-1.5 bg-white/10 rounded-lg text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white tracking-wide">Data Mahasiswa Baru</h3>
                </div>
            </div>

            <form action="{{ route('mahasiswa.proses') }}" method="POST" class="p-6 md:p-8 space-y-6 bg-white">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">NIM</label>
                        <input type="text" name="nim" value="{{ old('nim') }}"
                               class="w-full px-4 py-2.5 bg-slate-50 border @error('nim') border-rose-300 bg-rose-50/30 focus:ring-rose-100 focus:border-rose-400 @else border-slate-200 focus:ring-blue-50 focus:border-blue-500 @enderror rounded-xl focus:outline-none focus:ring-4 transition text-slate-800 placeholder-slate-400 text-sm font-medium"
                               placeholder="Contoh: 21010123">
                        @error('nim')
                            <p class="text-xs text-rose-600 mt-1.5 font-semibold flex items-center gap-1">
                                <span class="w-1 h-1 rounded-full bg-rose-500"></span>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama') }}"
                               class="w-full px-4 py-2.5 bg-slate-50 border @error('nama') border-rose-300 bg-rose-50/30 focus:ring-rose-100 focus:border-rose-400 @else border-slate-200 focus:ring-blue-50 focus:border-blue-500 @enderror rounded-xl focus:outline-none focus:ring-4 transition text-slate-800 placeholder-slate-400 text-sm font-medium"
                               placeholder="Contoh: Alex Utama">
                        @error('nama')
                            <p class="text-xs text-rose-600 mt-1.5 font-semibold flex items-center gap-1">
                                <span class="w-1 h-1 rounded-full bg-rose-500"></span>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full px-4 py-2.5 bg-slate-50 border @error('email') border-rose-300 bg-rose-50/30 focus:ring-rose-100 focus:border-rose-400 @else border-slate-200 focus:ring-blue-50 focus:border-blue-500 @enderror rounded-xl focus:outline-none focus:ring-4 transition text-slate-800 placeholder-slate-400 text-sm font-medium"
                               placeholder="alex@mahasiswa.ac.id">
                        @error('email')
                            <p class="text-xs text-rose-600 mt-1.5 font-semibold flex items-center gap-1">
                                <span class="w-1 h-1 rounded-full bg-rose-500"></span>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Jurusan</label>
                        <div class="relative">
                            <select name="jurusan_id"
                                    class="w-full px-4 py-2.5 bg-slate-50 border @error('jurusan_id') border-rose-300 bg-rose-50/30 focus:ring-rose-100 focus:border-rose-400 @else border-slate-200 focus:ring-blue-50 focus:border-blue-500 @enderror rounded-xl focus:outline-none focus:ring-4 transition text-slate-800 text-sm font-medium appearance-none cursor-pointer">
                                <option value="" class="text-slate-400">-- Pilih Jurusan --</option>
                                <option value="1" {{ old('jurusan_id') == '1' ? 'selected' : '' }}>Teknik Informatika (TI)</option>
                                <option value="2" {{ old('jurusan_id') == '2' ? 'selected' : '' }}>Sistem Informasi (SI)</option>
                                <option value="3" {{ old('jurusan_id') == '3' ? 'selected' : '' }}>Manajemen Informatika (MI)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        @error('jurusan_id')
                            <p class="text-xs text-rose-600 mt-1.5 font-semibold flex items-center gap-1">
                                <span class="w-1 h-1 rounded-full bg-rose-500"></span>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Jenis Kelamin</label>
                        <div class="flex items-center gap-8 bg-slate-50 border border-slate-200/80 rounded-xl px-5 py-3">
                            <label class="inline-flex items-center cursor-pointer group">
                                <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} class="form-radio text-blue-600 focus:ring-blue-500/50 h-4 w-4 bg-white border-slate-300">
                                <span class="ml-2.5 text-sm font-semibold text-slate-600 group-hover:text-slate-900 transition-colors">Laki-laki</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer group">
                                <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }} class="form-radio text-blue-600 focus:ring-blue-500/50 h-4 w-4 bg-white border-slate-300">
                                <span class="ml-2.5 text-sm font-semibold text-slate-600 group-hover:text-slate-900 transition-colors">Perempuan</span>
                            </label>
                        </div>
                        @error('jenis_kelamin')
                            <p class="text-xs text-rose-600 mt-1.5 font-semibold flex items-center gap-1">
                                <span class="w-1 h-1 rounded-full bg-rose-500"></span>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Alamat</label>
                    <textarea name="alamat" rows="3"
                              class="w-full px-4 py-2.5 bg-slate-50 border @error('alamat') border-rose-300 bg-rose-50/30 focus:ring-rose-100 focus:border-rose-400 @else border-slate-200 focus:ring-blue-50 focus:border-blue-500 @enderror rounded-xl focus:outline-none focus:ring-4 transition text-slate-800 placeholder-slate-400 text-sm font-medium resize-none"
                              placeholder="Tulis alamat lengkap rumah saat ini...">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <p class="text-xs text-rose-600 mt-1.5 font-semibold flex items-center gap-1">
                            <span class="w-1 h-1 rounded-full bg-rose-500"></span>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex justify-end pt-5 border-t border-slate-100">
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm rounded-xl shadow-md hover:shadow-lg active:scale-[0.98] transition-all duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Mahasiswa
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
