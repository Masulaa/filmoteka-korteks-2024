@extends('layouts.app')

@section('content')
    <div class="max-w-2xl px-4 pt-4 pb-16 mx-auto sm:px-6 sm:pb-24 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-white">Movies</h2>

        @if (isset($error))
            <p class="mt-6 text-center text-red-500">{{ $error }}</p>
        @elseif ($movies->count() > 0)
            <div class="grid grid-cols-1 mt-6 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($movies as $movie)
                    <div class="relative group">

                        <div
                            class="w-full overflow-hidden bg-gray-200 rounded-md aspect-h-1 aspect-w-1 lg:aspect-none group-hover:opacity-75 lg:h-80">
                            <img src="{{ $movie->image }}" alt="{{ $movie->title }}"
                                class="object-cover object-center w-full h-full lg:h-full lg:w-full">
                        </div>
                        <div class="flex justify-between mt-4">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a href=" {{ route('movie', $movie->id) }}">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $movie->title }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">{{ $movie->genre }}</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">{{ $movie->director }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="mt-6 text-lg text-center text-gray-900 dark:text-white">No movies found matching the selected
                criteria.</p>
        @endif

        <div class="mt-8">
            {{ $movies->links() }}
        </div>
    </div>
@endsection
