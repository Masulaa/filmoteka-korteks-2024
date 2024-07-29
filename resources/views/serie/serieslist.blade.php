@extends('layouts.app')


@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.add-to-favorites-button').forEach(button => {
                button.addEventListener('click', function (event) {
                    event.stopPropagation();
                    event.preventDefault();

                    const userId = this.dataset.userId;
                    const serieId = this.dataset.serieId;

                    fetch('{{ route('serie-favorites.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            user_id: userId,
                            serie_id: serieId
                        })
                    })
                    .then(response => {
                        if (response.status === 201) {
                            return response.json().then(data => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            });
                        } else if (response.status === 200) {
                            return response.json().then(data => {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Info',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            });
                        } else {
                            throw new Error('Unexpected response');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    });
                });
            });
        });
    </script>
        @if ((isset($movies) && $movies->count() > 0) || (isset($serie) && $serie->count() > 0))
        @include('layouts.serie-filter')  <livewire:serie-search />
    @endif 
    <div class="min-h-screen py-12 transition-colors duration-300 bg-gray-100 dark:bg-gray-900">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="mb-8 text-3xl font-extrabold text-gray-900 dark:text-white animate-fade-in">Discover Series</h1>

            @if (isset($error))
                <div class="p-4 mb-8 text-red-700 bg-red-100 border-l-4 border-red-500 dark:bg-red-900 dark:text-red-300 animate-shake"
                    role="alert">
                    <p>{{ $error }}</p>
                </div>
            @elseif ($serie->count() > 0)
                <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                    @foreach ($serie as $ser)
                        <div class="overflow-hidden transition duration-300 transform bg-white rounded-lg shadow-md group dark:bg-gray-800 hover:scale-105 hover:shadow-xl animate-fade-in-up"
                            style="animation-delay: {{ $loop->index * 100 }}ms">
                            <a href="{{ route('series.show', $ser->id) }}" class="block">
                                <div class="relative aspect-w-2 aspect-h-3">
                                    <img src="{{ $ser->image }}" alt="{{ $ser->title }}"
                                        class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
                                    <div
                                        class="absolute inset-0 flex items-center justify-center transition-all duration-300 bg-black bg-opacity-50 opacity-0 group-hover:scale-110 group-hover:opacity-100">
                                        <button
                                            onclick="event.stopPropagation(); event.preventDefault();"
                                            class="px-4 py-2 text-white transition-colors duration-300 bg-indigo-600 rounded-md hover:bg-indigo-700 animate-pulse add-to-favorites-button"
                                            data-user-id="{{ auth()->id() }}" data-serie-id="{{ $ser->id }}">
                                            Add to Favorites
                                        </button>
                                    </div>
                                </div>
                                <div class="px-4 py-3 mt-2">
                                    <h3
                                        class="text-lg font-semibold text-gray-900 transition-colors duration-300 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                                        {{ $ser->title }}
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $ser->genre }}</p>
                                    <p class="mt-1 text-sm font-medium text-gray-700 dark:text-gray-300">Directed by:
                                        {{ $ser->director }}</p>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                        {{ Str::limit($ser->overview, 100) }}</p>
                                    <div class="flex items-center mt-3">
                                        <svg class="flex-shrink-0 w-5 h-5 text-yellow-400" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <p class="ml-1 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $ser->averageRating() }} ({{ $ser->countRatings() }} ratings)</p>
                                    </div>
                                    <div class="flex items-center mt-3">
                                    <svg class="flex-shrink-0 w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 5c-7.633 0-12 7-12 7s4.367 7 12 7 12-7 12-7-4.367-7-12-7zm0 12c-2.761 0-5-2.239-5-5s2.239-5 5-5 5 2.239 5 5-2.239 5-5 5zm0-8c-1.654 0-3 1.346-3 3s1.346 3 3 3 3-1.346 3-3-1.346-3-3-3z"/>
                                    </svg>
                                        <p class="ml-1 text-sm text-gray-600 dark:text-gray-400">Views: {{ $ser->views }}</p>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Released:
                                        {{ $ser->release_date }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center animate-fade-in">
                    <p class="text-xl text-gray-600 dark:text-gray-400">No series found matching the selected criteria.</p>
                </div>
            @endif

            <div class="mt-12">
                {{ $serie->links() }}
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out;
        }

        .animate-shake {
            animation: shake 0.5s ease-in-out;
        }

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        .aspect-w-2 {
            position: relative;
            padding-bottom: 150%;
            /* 2:3 aspect ratio */
        }

        .aspect-w-2>img {
            position: absolute;
            height: 100%;
            width: 100%;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            object-fit: cover;
            object-position: center;
        }
    </style>
@endpush
