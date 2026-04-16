<x-app-layout>
    <x-slot:title>
        {{ $pageTitle }}
    </x-slot:title>

    <div class="border-b pb-4 mb-6">
        <h2 class="text-3xl font-extrabold text-blue-700">{{ $courseInfo['subject'] }}</h2>
        <p class="text-gray-600 italic">{{ $courseInfo['campus'] }}</p>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
        <section>
            <h3 class="text-xl font-semibold mb-3">Informasi Mata Kuliah</h3>
            <ul class="space-y-2">
                <li><strong>Instruktur:</strong> {{ $courseInfo['instructor'] }}</li>
                <li><strong>Deskripsi:</strong> {{ $courseInfo['summary'] }}</li>
            </ul>
        </section>

        <section class="bg-blue-50 p-4 rounded-lg">
            <h3 class="text-xl font-semibold mb-3 text-blue-800">Silabus Materi</h3>
            <ul class="list-disc list-inside space-y-1">
                @foreach($curriculum as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </section>
    </div>
</x-app-layout>