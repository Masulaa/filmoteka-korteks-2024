<div class="hidden px-4 mx-auto mt-8 max-w-7xl sm:px-6 lg:px-8">
    <form id="filter-form" action="{{ route('series.filter') }}" method="GET"
        class="flex flex-col max-w-md mx-auto space-y-6">

        <div class="p-8 bg-gray-800 rounded-xl filter-container">

            <div class="flex items-center justify-between pb-2 mb-6 border-b rounded-t border-gray-600">
                <div class="invisible w-8 h-8"></div>
                <h3 class="text-xl font-semibold text-center text-gray-900 dark:text-white w-80">
                    Filters
                </h3>
                <button type="button" onclick="toggleFilter()"
                    class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div class="max-w-full mx-auto mb-6">
                <h3 class="mb-4 text-lg font-semibold text-white/90">Select Year Range</h3>
                <div class="range">
                    <div class="relative h-1 mx-5 rounded-sm bg-white/90">
                        <span class="absolute h-full bg-indigo-700 rounded-md range-selected"></span>
                    </div>
                    <div class="relative range-input">
                        <input type="range" class="absolute w-full h-1 top-[-7px] bg-transparent pointer-events-none appearance-none" name="min_year" min="1900" max="{{ date('Y') }}" value="1900" step="1">
                        <input type="range" class="absolute w-full h-1 top-[-7px] bg-transparent pointer-events-none appearance-none" name="max_year" min="1900" max="{{ date('Y') }}" value="{{ date('Y') }}" step="1">
                    </div>
                    <div class="flex justify-between items-center mt-8">
                        <div class="flex flex-col items-center">
                            <label for="min_year" class="text-sm mb-1 text-white">Min Year</label>
                            <input type="number" name="min_year" value="1900" min="1900" max="{{ date('Y') }}" class="w-20 p-2 border border-gray-600 rounded bg-transparent text-center text-white focus:outline-none focus:border-indigo-700">
                        </div>
                        <div class="flex flex-col items-center">
                            <label for="max_year" class="text-sm mb-1 text-white">Max Year</label>
                            <input type="number" name="max_year" value="{{ date('Y') }}" min="1900" max="{{ date('Y') }}" class="w-20 p-2 border border-gray-600 rounded bg-transparent text-center text-white focus:outline-none focus:border-indigo-700">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-6 genre-select">
                <label for="genre" class="block mb-2 text-sm font-medium text-white/90">Select Genre</label>
                <select name="genre" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-700 dark:focus:border-indigo-700">
                <option value="">All Genres</option>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->name }}" {{ request('genre') == $genre->name ? 'selected' : '' }}>{{ $genre->name }}</option>
                @endforeach
                </select>
            </div>

            <button type="submit" class="w-full px-4 py-2 text-white transition-colors duration-300 bg-indigo-700 rounded-lg hover:bg-blue-600">Filter Series</button>
        </div>
    </form>
</div>
<div class="flex justify-center mt-6 filter-btn"></div>

<script>
    function seriesToggleFilter() {
        const filter = document.querySelector('.filter-toggle');
        const btn = document.querySelector('.filter-btn');
        if (filter.style.display === "none" || filter.style.display === "") {
            filter.style.display = "block";
            btn.style.display = "none";
        } else {
            filter.style.display = "none";
            btn.style.display = "block";
        }
    }

    const rangeMin = 1;
    const range = document.querySelector(".range-selected");
    const rangeInput = document.querySelectorAll(".range-input input");
    const rangePrice = document.querySelectorAll(".range-price input");

    function setRange() {
        let minRange = parseInt(rangeInput[0].value);
        let maxRange = parseInt(rangeInput[1].value);
        if (maxRange - minRange < rangeMin) {
            if (minRange === parseInt(rangeInput[0].max)) {
                maxRange = minRange;
            } else {
                maxRange = minRange + rangeMin;
            }
            rangeInput[1].value = maxRange;
        }
        rangePrice[0].value = minRange;
        rangePrice[1].value = maxRange;
        range.style.left = ((minRange - rangeInput[0].min) / (rangeInput[0].max - rangeInput[0].min)) * 100 + "%";
        range.style.right = 100 - ((maxRange - rangeInput[1].min) / (rangeInput[1].max - rangeInput[1].min)) * 100 + "%";
    }
    rangeInput.forEach((input) => {
        input.addEventListener("input", setRange);
    });
    rangePrice.forEach((input, index) => {
        input.addEventListener("change", (e) => {
            if (e.target.value > parseInt(rangeInput[index].max)) {
                e.target.value = rangeInput[index].max;
            }
            if (e.target.value < parseInt(rangeInput[index].min)) {
                e.target.value = rangeInput[index].min;
            }
            rangeInput[index].value = e.target.value;
            setRange();
        });
    });
</script>
