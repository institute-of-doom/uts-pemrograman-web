<x-app-layout>
    <x-slot:title>
        {{ $pageTitle }}
    </x-slot:title>

    @if (session('success'))
        <div class="mb-8 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-xl text-sm text-emerald-800 font-medium shadow-sm flex items-center gap-3 animate-fade-in">
            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="relative bg-gradient-to-r from-blue-700 to-indigo-800 rounded-2xl p-6 md:p-8 shadow-md mb-8 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="relative z-10">
            <div class="flex items-center gap-2 text-blue-100 text-xs font-semibold uppercase tracking-wider mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                {{ $courseInfo['campus'] }}
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight">{{ $courseInfo['subject'] }}</h2>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8 items-start">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h3 class="text-xl font-bold text-slate-800 mb-5 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Informasi Mata Kuliah
                </h3>

                <div class="space-y-5">
                    <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="p-2.5 bg-blue-100 text-blue-700 rounded-lg shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Dosen Pengampu</span>
                            <span class="text-base font-semibold text-slate-700">{{ $courseInfo['instructor'] }}</span>
                        </div>
                    </div>

                    <div class="prose prose-slate max-w-none">
                        <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Deskripsi Kursus</span>
                        <p class="text-slate-600 leading-relaxed text-sm md:text-base">
                            {{ $courseInfo['summary'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="bg-slate-50 border-b border-slate-100 p-5">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Silabus Materi
                </h3>
            </div>

            <div class="p-5">
                <ul class="divide-y divide-slate-100">
                    @foreach($curriculum as $index => $item)
                        <li class="py-3 flex items-start gap-3 text-sm text-slate-600 first:pt-0 last:pb-0 group hover:bg-slate-50/50 rounded-lg transition-colors duration-150">
                            <span class="flex items-center justify-center w-5 h-5 rounded-full bg-indigo-50 text-indigo-600 text-xs font-bold shrink-0 mt-0.5">
                                {{ $index + 1 }}
                            </span>
                            <span class="group-hover:text-slate-900 transition-colors duration-150">{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
</x-app-layout>
