@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function removeFromFavorites(movieId) {
            const userId = {{ auth()->id() }};

            fetch(`/favorites/${movieId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    user_id: userId,
                    movie_id: movieId
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });

                document.getElementById(`movie-card-${movieId}`).remove();
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            });
        }
    </script>
    <div class="min-h-screen py-12 transition-colors duration-300 bg-gray-100 dark:bg-gray-900">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="mb-8 text-3xl font-extrabold text-gray-900 dark:text-white animate-fade-in">My Favorite Movies</h1>

            @if ($favoriteMovies->count() > 0)
                <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                    @foreach ($favoriteMovies as $movie)
                    <div id="movie-card-{{ $movie->id }}" class="overflow-hidden transition duration-300 transform bg-white rounded-lg shadow-md group dark:bg-gray-800 hover:scale-105 hover:shadow-xl animate-fade-in-up" style="animation-delay: {{ $loop->index * 100 }}ms">
                            <a href="{{ route('movies.index') }}/ {{ $movie->id }}" class="block">
                                <div class="relative aspect-w-2 aspect-h-3">
                                    <img src="{{ $movie->image }}" alt="{{ $movie->title }}"
                                        class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
                                    <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 bg-black bg-opacity-50 opacity-0 group-hover:scale-110 group-hover:opacity-100">
                                        <button
                                            onclick="event.stopPropagation(); event.preventDefault(); removeFromFavorites({{ $movie->id }});"
                                            class="px-4 py-2 text-white transition-colors duration-300 bg-red-600 rounded-md hover:bg-red-700 animate-pulse remove-from-favorites-button"
                                            data-movie-id="{{ $movie->id }}">
                                            Remove from Favorites
                                        </button>
                                    </div>
                                </div>
                                <div class="px-4 py-3 mt-2">
                                    <h3 class="text-lg font-semibold text-gray-900 transition-colors duration-300 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                                        {{ $movie->title }}
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $movie->genre }}</p>
                                    <p class="mt-1 text-sm font-medium text-gray-700 dark:text-gray-300">Directed by:
                                        {{ $movie->director }}</p>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                        {{ Str::limit($movie->overview, 100) }}</p>
                                    <div class="flex items-center mt-3">
                                        <svg class="flex-shrink-0 w-5 h-5 text-yellow-400" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <p class="ml-1 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $movie->averageRating() }} ({{ $movie->countRatings() }} ratings)
                                        </p>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Released:
                                        {{ $movie->release_date }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center animate-fade-in">
                    <p class="text-xl text-gray-600 dark:text-gray-400">You have no favorite movies.</p>
                </div>
            @endif
        </div>
    </div>
    <form id="removeFromFavoritesForm" action="#" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection
