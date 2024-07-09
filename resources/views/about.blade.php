@extends('layouts.app')

@section('content')



<div class="dark-white py-24 sm:py-32">
    <div class="mx-auto grid max-w-7xl gap-x-8 gap-y-20 px-6 lg:px-8 xl:grid-cols-3">
        <div class="max-w-2xl">
            <h2 class="text-5xl font-bold tracking-tight text-white sm:text-4xl">Meet our team</h2>
            <p class="mt-6 text-lg leading-8 text-gray-600">Welcome to our movie haven! We're a team of film enthusiasts
                dedicated to bringing you the best in movie ratings, reviews, and trailers.</p>
        </div>
        <ul role="list" class="grid gap-x-8 gap-y-12 sm:grid-cols-2 sm:gap-y-16 xl:col-span-2">
            <li>
                <div class="flex items-center gap-x-6">
                    <img class="h-16 w-16 rounded-full"
                        src="https://plus.unsplash.com/premium_photo-1661337198455-18b93a017a4e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="">
                    <div>
                        <h3 class="text-base font-semibold leading-7 tracking-tight text-white">Boris Bojičić</h3>
                        <p class="text-sm font-semibold leading-6 text-indigo-600">Developer</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="flex items-center gap-x-6">
                    <img class="h-16 w-16 rounded-full" src="https://avatars.githubusercontent.com/u/69390868?v=4"
                        alt="">
                    <div>
                        <h3 class="text-base font-semibold leading-7 tracking-tight text-white">Luka Lučić</h3>
                        <p class="text-sm font-semibold leading-6 text-indigo-600">Developer</p>
                    </div>
                </div>
            </li>

            <li>
                <div class="flex items-center gap-x-6">
                    <img class="h-16 w-16 rounded-full"
                        src="https://images.unsplash.com/photo-1625604238425-05f1b2461f50?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="">
                    <div>
                        <h3 class="text-base font-semibold leading-7 tracking-tight text-white">Luka Mašulović</h3>
                        <p class="text-sm font-semibold leading-6 text-indigo-600">Developer</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="flex items-center gap-x-6">
                    <img class="h-16 w-16 rounded-full" src="https://avatars.githubusercontent.com/u/171392164?v=4"
                        alt="">
                    <div>
                        <h3 class="text-base font-semibold leading-7 tracking-tight text-white">Jovan Kešeljević</h3>
                        <p class="text-sm font-semibold leading-6 text-indigo-600">Developer</p>
                    </div>
                </div>
            </li>

            <!-- More people... -->
        </ul>
    </div>
</div>

@endsection