{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Academic App' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- The Navbar Partial --}}
    @include('partials._navbar')

    <main class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        {{ $slot }}
    </main>

    <footer class="text-center mt-10 pb-10 text-gray-400 text-xs uppercase tracking-widest">
        &copy; {{ date('Y') }} STMIK Antar Bangsa • Laravel Architecture
    </footer>

</body>
</html>