<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.header')
        @if (!Route::is('movie') && $movies->count() > 0)
            <div class="px-4 mx-auto mt-1 max-w-7xl sm:px-6 lg:px-8">
                <form id="filter-form" action="{{ route('movies.filter') }}" method="GET">
                    <select name="genre" class="form-select">
                        <option value="">All Genres</option>
                        <option value="Action" {{ request('genre') == 'Action' ? 'selected' : '' }}>Action</option>
                        <option value="Comedy" {{ request('genre') == 'Comedy' ? 'selected' : '' }}>Comedy</option>
                        <option value="Drama" {{ request('genre') == 'Drama' ? 'selected' : '' }}>Drama</option>
                        <!-- Add more genre options -->
                    </select>
                    <select name="year" class="form-select">
                        <option value="">All Years</option>
                        @for ($i = date('Y'); $i >= 1900; $i--)
                            <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                    </select>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Filter</button>
                </form>
            </div>
            @include('layouts.search')

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


    <script>
        document.getElementById('filter-form').addEventListener('submit', function(event) {
            const form = event.target;
            const genre = form.querySelector('[name="genre"]').value;
            const year = form.querySelector('[name="year"]').value;

            if (!genre) {
                form.querySelector('[name="genre"]').disabled = true;
            }
            if (!year) {
                form.querySelector('[name="year"]').disabled = true;
            }
        });
    </script>
</body>

</html>
