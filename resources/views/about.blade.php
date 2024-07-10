@extends('layouts.app')
@section('content')
    <div class="py-24 transition-colors duration-300 bg-gray-100 dark:bg-gray-900 sm:py-32">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="max-w-2xl mx-auto mb-16 text-center">
                <h2 class="mb-4 text-5xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Meet Our Team
                </h2>
                <p class="text-lg leading-8 text-gray-600 dark:text-gray-300">We're a team of passionate developers and
                    designers who've combined our love for cinema with technology.Together, we're revolutionizing how you
                    discover, rate, and experience
                    movies in the digital age!
                </p>
            </div>

            <div class="grid gap-12 lg:grid-cols-3 lg:gap-x-8 lg:gap-y-20">
                <div class="space-y-8">
                    <h3 class="text-3xl font-semibold text-gray-900 dark:text-white">Our Mission</h3>
                    <p class="text-gray-600 dark:text-gray-300">At MovieRaters, we strive to create a community where movie
                        lovers can discover, discuss, and celebrate the art of cinema. Our goal is to provide accurate
                        ratings, insightful reviews, and easy access to trailers, all in one place.</p>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('home') }}"
                            class="text-indigo-600 transition-colors duration-300 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200">Explore</a>
                        <a href="{{ route('contactsshow') }}"
                            class="text-indigo-600 transition-colors duration-300 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200">Contact
                            Us</a>
                    </div>
                </div>

                <ul role="list" class="grid gap-8 sm:grid-cols-2 lg:col-span-2">

                    <li class="transition-transform duration-300 transform hover:scale-105">
                        <div class="flex flex-col items-center p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <img class="w-24 h-24 mb-4 rounded-full"
                                src="https://plus.unsplash.com/premium_photo-1661337198455-18b93a017a4e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Boris Bojičić">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Boris Bojičić</h3>
                            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400">Developer</p>
                            <p class="mt-2 text-sm text-center text-gray-600 dark:text-gray-300"></p>
                            <a href="https://github.com/Boja21" target="_blank" rel="noopener noreferrer"
                                class="mt-4 text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </li>
                    <li class="transition-transform duration-300 transform hover:scale-105">
                        <div class="flex flex-col items-center p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <img class="w-24 h-24 mb-4 rounded-full"
                                src="https://images.unsplash.com/photo-1625604238425-05f1b2461f50?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Luka Mašulović">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Luka Mašulović</h3>
                            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400">Developer</p>
                            <p class="mt-2 text-sm text-center text-gray-600 dark:text-gray-300"></p>
                            <a href="https://github.com/Masulaa" target="_blank" rel="noopener noreferrer"
                                class="mt-4 text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </li>
                    <li class="transition-transform duration-300 transform hover:scale-105">
                        <div class="flex flex-col items-center p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <img class="w-24 h-24 mb-4 rounded-full"
                                src="https://avatars.githubusercontent.com/u/69390868?v=4" alt="Luka Lučić">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Luka Lučić</h3>
                            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400">Developer</p>
                            <p class="mt-2 text-sm text-center text-gray-600 dark:text-gray-300"></p>
                            <a href="https://github.com/lucic15" target="_blank" rel="noopener noreferrer"
                                class="mt-4 text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </li>

                    <li class="transition-transform duration-300 transform hover:scale-105">
                        <div class="flex flex-col items-center p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <img class="w-24 h-24 mb-4 rounded-full"
                                src="https://avatars.githubusercontent.com/u/171392164?v=4" alt="Jovan Kešeljević">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Jovan Kešeljević</h3>
                            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400">Developer</p>
                            <p class="mt-2 text-sm text-center text-gray-600 dark:text-gray-300"></p>
                            <a href="https://github.com/keseljevicjovan" target="_blank" rel="noopener noreferrer"
                                class="mt-4 text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="mt-16 text-center">
                <h3 class="mb-4 text-3xl font-semibold text-gray-900 dark:text-white">Join Our Community</h3>
                <p class="mb-6 text-gray-600 dark:text-gray-300">Stay updated with the latest movie news, reviews, and
                    exclusive content.</p>
                <form class="max-w-md mx-auto">
                    <div class="flex items-center">
                        <input type="email" placeholder="Enter your email"
                            class="flex-grow px-4 py-2 text-gray-900 bg-white border border-gray-300 rounded-l-md dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <button type="submit"
                            class="px-4 py-2 text-white transition-colors duration-300 bg-indigo-600 rounded-r-md hover:bg-indigo-700">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .max-w-2xl,
        .grid,
        .mt-16 {
            animation: fadeIn 1s ease-out;
        }
    </style>
@endsection
