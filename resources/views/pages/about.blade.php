<x-app-layout>
    <x-slot:title>
        {{ $meta->title }}
    </x-slot:title>

    <div class="max-w-2xl mx-auto text-center">
        <h2 class="text-2xl font-bold mb-4">Tentang Aplikasi</h2>
        <div class="bg-gray-100 p-6 rounded-lg inline-block text-left">
            <table class="table-auto w-full">
                <tr>
                    <td class="pr-4 font-semibold">Nama Aplikasi:</td>
                    <td>{{ $meta->name }}</td>
                </tr>
                <tr>
                    <td class="pr-4 font-semibold">Versi:</td>
                    <td><span class="bg-green-200 text-green-800 px-2 py-1 rounded text-xs">{{ $meta->version }}</span></td>
                </tr>
                <tr>
                    <td class="pr-4 font-semibold">Pengembang:</td>
                    <td>{{ $meta->author }}</td>
                </tr>
            </table>
        </div>
        
        <div class="mt-8">
            <a href="{{ url('/') }}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</x-app-layout>