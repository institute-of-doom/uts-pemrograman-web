<x-app-layout>
    <x-slot:title>
        {{ $meta->title }}
    </x-slot:title>

    <div class="max-w-xl mx-auto my-12">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-xl p-8 text-center relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-blue-600 to-indigo-600"></div>

            <div class="mx-auto w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-4 shadow-inner">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>

            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight mb-2">Tentang Aplikasi</h2>
            <p class="text-sm text-slate-500 mb-8">Informasi spesifikasi dan rilis sistem yang aktif</p>

            <div class="bg-slate-50 rounded-xl border border-slate-100 p-2 divide-y divide-slate-200/60 text-left mb-8">
                <div class="flex items-center justify-between p-4">
                    <span class="text-sm font-semibold text-slate-500">Nama Aplikasi</span>
                    <span class="text-sm font-bold text-slate-800 tracking-wide">{{ $meta->name }}</span>
                </div>
                <div class="flex items-center justify-between p-4">
                    <span class="text-sm font-semibold text-slate-500">Versi</span>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        {{ $meta->version }}
                    </span>
                </div>
                <div class="flex items-center justify-between p-4">
                    <span class="text-sm font-semibold text-slate-500">Pengembang</span>
                    <span class="text-sm font-medium text-slate-700 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 012-2h10a2 2 0 012 2m-14 0a2 2 0 002 2h10a2 2 0 002-2M7 8l5-5 5 5M7 16l5 5 5-5"/>
                        </svg>
                        {{ $meta->author }}
                    </span>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-3 pt-2">
                <a href="{{ route('profile') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl shadow-sm transition-all duration-150 group">
                    <svg class="w-4 h-4 text-blue-200 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Lihat Profil Saya
                </a>

                <a href="{{ url('/') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-slate-800 hover:bg-slate-900 text-white font-semibold text-sm rounded-xl shadow-sm transition-all duration-150 group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
