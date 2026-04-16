<x-app-layout>
    <x-slot:title>
        Profil Mahasiswa
    </x-slot:title>

    <div class="max-w-4xl mx-auto">
        <div class="flex items-center space-x-8 mb-8 pb-6 border-b">
            <img src="{{ $user['avatar_url'] }}" alt="Avatar" class="w-24 h-24 rounded-full shadow-lg border-4 border-blue-100">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">{{ $user['name'] }}</h2>
                <p class="text-blue-600 font-medium">{{ $user['major'] }} • Semester {{ $user['semester'] }}</p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                <h3 class="text-sm uppercase tracking-wider text-gray-500 font-bold mb-4">Informasi Akademik</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-gray-600">NIM</dt>
                        <dd class="font-semibold text-gray-800">{{ $user['id_number'] }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Status Kuliah</dt>
                        <dd>
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-bold">
                                {{ $user['status'] }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                <h3 class="text-sm uppercase tracking-wider text-gray-500 font-bold mb-4">Kontak</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Email</dt>
                        <dd class="font-semibold text-gray-800 text-sm">{{ $user['email'] }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600">GitHub</dt>
                        <dd class="font-semibold text-gray-800 text-sm">{{ $user['github'] }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>