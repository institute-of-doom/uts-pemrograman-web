<x-app-layout>
    <x-slot:title>
        Profil Mahasiswa & Developer
    </x-slot:title>

    <div class="max-w-3xl mx-auto my-12 px-4">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl overflow-hidden">
            <div class="h-32 bg-gradient-to-r from-slate-900 via-blue-900 to-slate-900 relative">
                <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:12px_12px]"></div>
            </div>

            <div class="px-6 pb-8 text-center relative">
                <div class="flex justify-center">
                    <div class="relative -mt-20 mb-4 inline-block">
                        <img src="{{ $user['avatar_url'] }}" alt="Avatar" class="w-32 h-32 rounded-full object-cover ring-4 ring-white shadow-2xl bg-white">
                        <span class="absolute bottom-1 right-2 w-5 h-5 rounded-full bg-emerald-500 ring-4 ring-white animate-pulse"></span>
                    </div>
                </div>

                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight mb-1">{{ $user['name'] }}</h2>
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-wider mb-2">{{ $user['major'] }}</p>

                <div class="flex justify-center items-center gap-2 mb-8">
                    <span class="px-2.5 py-1 rounded-md bg-slate-100 text-slate-600 text-xs font-bold border border-slate-200">
                        Semester {{ $user['semester'] }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-200">
                        {{ $user['status'] }}
                    </span>
                </div>

                <div class="grid md:grid-cols-2 gap-4 max-w-2xl mx-auto">
                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-5 text-left flex flex-col justify-between">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            </svg>
                            Akademik
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between border-b border-slate-200/50 pb-2 last:border-0 last:pb-0">
                                <span class="text-xs font-medium text-slate-500">Nomor Induk / NIM</span>
                                <span class="text-sm font-mono font-bold text-slate-700 tracking-wider">{{ $user['id_number'] }}</span>
                            </div>
                            <div class="flex items-center justify-between border-b border-slate-200/50 pb-2 last:border-0 last:pb-0">
                                <span class="text-xs font-medium text-slate-500">Peran Sistem</span>
                                <span class="text-xs font-bold text-blue-600 bg-blue-50 border border-blue-100 px-2 py-0.5 rounded">Developer</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-5 text-left flex flex-col justify-between">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L22 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Hubungi
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between border-b border-slate-200/50 pb-2 last:border-0 last:pb-0">
                                <span class="text-xs font-medium text-slate-500">Email</span>
                                <a href="mailto:{{ $user['email'] }}" class="text-sm font-medium text-slate-700 hover:text-blue-600 transition-colors">{{ $user['email'] }}</a>
                            </div>
                            <div class="flex items-center justify-between border-b border-slate-200/50 pb-2 last:border-0 last:pb-0">
                                <span class="text-xs font-medium text-slate-500">GitHub</span>
                                <a href="https://github.com/{{ $user['github'] }}" target="_blank" class="text-sm font-bold text-slate-800 hover:text-indigo-600 flex items-center gap-1 transition-colors">
                                    {{ $user['github'] }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
