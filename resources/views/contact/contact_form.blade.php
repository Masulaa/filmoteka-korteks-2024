@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen px-4 py-12 dark:bg-gray-900 sm:px-6 lg:px-8">

    <div class="max-w-md p-8 mx-auto bg-white rounded-lg shadow-md dark:bg-gray-800">
        <h2 class="mb-8 text-2xl font-bold text-center text-gray-900 dark:text-white">Contact Us</h2>
        <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                    <input id="name" name="name" type="text" required
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email
                        address</label>
                    <input id="email" name="email" type="email" required
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                </div>
            </div>
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                <textarea id="content" name="content" rows="4" required
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"></textarea>
            </div>
            <div>
                <button type="submit"
                    class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                    Submit
                </button>
            </div>
        </form>
    </div>
    @endsection