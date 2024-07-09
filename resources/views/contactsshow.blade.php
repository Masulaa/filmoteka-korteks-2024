@extends('layouts.app')

@section('content')

<div class="min-h-screen flex flex-col items-center justify-center bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <!-- <div class="flex flex-col items-center justify-center">
        <x-application-logo class="block w-auto text-gray-800 fill-current h-40 dark:text-gray-200" />
    </div> -->
    <div class="max-w-md w-full bg-gray-800 p-8 rounded-lg shadow-md">
        <h2 class="text-center text-3xl font-extrabold text-white mb-8">Contact Us</h2>
        <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6">
            @csrf
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="name" class="sr-only">Name</label>
                    <input id="name" name="name" type="text" required
                        class="w-full p-2 text-white bg-gray-900 border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Name">
                </div>
                <div class="flex-1">
                    <label for="email" class="sr-only">Email address</label>
                    <input id="email" name="email" type="email" required
                        class="w-full p-2 text-white bg-gray-900 border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Email address">
                </div>
            </div>
            <div>
                <label for="content" class="sr-only">Description</label>
                <textarea id="content" name="content" rows="4" required
                    class="w-full p-2 text-white bg-gray-900 border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Description"></textarea>
            </div>
            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

@endsection