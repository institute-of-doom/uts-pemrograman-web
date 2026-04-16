<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Academic App' }} - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <nav class="bg-blue-600 p-4 text-white shadow-lg">
        <div class="container mx-auto flex justify-between">
            <h1 class="font-bold text-xl">LaraLearn</h1>
            <div class="space-x-4">
                <a href="{{ url('/') }}" class="hover:underline">Home</a>
                <a href="{{ url('/about') }}" class="hover:underline">About</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        {{ $slot }}
    </main>

    <footer class="text-center mt-10 pb-10 text-gray-500 text-sm">
        &copy; {{ date('Y') }} Academic Laravel App.
    </footer>

</body>
</html>