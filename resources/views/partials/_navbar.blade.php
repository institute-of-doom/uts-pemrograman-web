{{-- resources/views/partials/_navbar.blade.php --}}
<nav class="bg-blue-700 p-4 text-white shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('home') }}" class="font-bold text-xl tracking-tight">
            LaraLearn
        </a>

        <div class="space-x-6 flex items-center">
            <a href="{{ route('home') }}" 
               class="transition duration-200 {{ request()->routeIs('home') ? 'text-yellow-300 font-bold' : 'hover:text-blue-200' }}">
                Home
            </a>
            
            <a href="{{ route('about') }}" 
               class="transition duration-200 {{ request()->routeIs('about') ? 'text-yellow-300 font-bold' : 'hover:text-blue-200' }}">
                About
            </a>
        </div>
    </div>
</nav>