<div class="flex items-center justify-center mt-8 mb-12">
    <div class="relative max-w-xl w-80">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
        <input wire:model.live="search" type="text"
            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-l-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
            placeholder="Search series..." required />
        <div id="serie_results"
            class="absolute left-0 right-0 z-10 mt-1 overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-700">
            @if(!empty($search))
                <ul>
                    @include('serie.serie_list', ['series' => $series])
                </ul>
            @endif
        </div>

    </div>
    <button onclick="toggleFilter()"
        class="p-4 text-white bg-indigo-600 rounded-r-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:hover:bg-indigo-600">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                clip-rule="evenodd" />
        </svg>
    </button>
</div>