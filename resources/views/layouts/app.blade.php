<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>THB Movies</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="https://i.ibb.co/7Vy4bJ6/krug.png" />
    <link rel="icon" href="https://i.ibb.co/7Vy4bJ6/krug.png" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.header')
        <!-- Привремено, док series не добије свој систем за search/filter -->
        @if ((isset($movies) && $movies->count() > 0) || (isset($series) && $series->count() > 0))
            @include('layouts.filter')
            <livewire:movie-search />
        @endif 

        <!-- Page Content -->
        <main class="flex-grow">
            @isset($slot)
                {{ $slot }}
            @else
                @yield('content')
            @endisset
        </main>

        <!-- Footer -->
        @include('layouts.footer')
    </div>
</body>

</html>