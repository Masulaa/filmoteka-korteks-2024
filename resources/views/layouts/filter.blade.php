<div class="px-4 mx-auto mt-8 max-w-7xl sm:px-6 lg:px-8">
    <form id="filter-form" action="{{ route('movies.filter') }}" method="GET"
        class="flex flex-col max-w-md mx-auto space-y-6">
        <div class="p-8 dark:bg-gray-800 w-80 rounded-xl filter-container">
            <h2 class="mb-6 text-2xl font-bold text-center dark:text-white">Filter Movies</h2>

            <div class="max-w-full mx-auto mb-6">
                <h3 class="mb-4 text-lg font-semibold dark:text-white/90">Select Year Range</h3>
                <div class="range">
                    <div class="relative h-1 mx-5 rounded-sm bg-white/90">
                        <span class="absolute h-full bg-blue-500 rounded-md range-selected"></span>
                    </div>
                    <div class="relative range-input">
                        <input type="range" class="min" name="min_year" min="1900" max="{{ date('Y') }}"
                            value="1900" step="1">
                        <input type="range" class="max" name="max_year" min="1900" max="{{ date('Y') }}"
                            value="{{ date('Y') }}" step="1">
                    </div>
                    <div class="range-price">
                        <div class="field">
                            <label for="min_year">Min Year</label>
                            <input type="number" name="min_year_display" value="1900" min="1900"
                                max="{{ date('Y') }}">
                        </div>
                        <div class="field">
                            <label for="max_year">Max Year</label>
                            <input type="number" name="max_year_display" value="{{ date('Y') }}" min="1900"
                                max="{{ date('Y') }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-6 genre-select">
                <label for="genre" class="block mb-2 text-sm font-medium text-white/90">Select Genre</label>
                <select name="genre"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">All Genres</option>
                    <option value="Action" {{ request('genre') == 'Action' ? 'selected' : '' }}>Action</option>
                    <option value="Adventure" {{ request('genre') == 'Adventure' ? 'selected' : '' }}>Adventure</option>
                    <option value="Animation" {{ request('genre') == 'Animation' ? 'selected' : '' }}>Animation</option>
                    <option value="Comedy" {{ request('genre') == 'Comedy' ? 'selected' : '' }}>Comedy</option>
                    <option value="Crime" {{ request('genre') == 'Crime' ? 'selected' : '' }}>Crime</option>
                    <option value="Drama" {{ request('genre') == 'Drama' ? 'selected' : '' }}>Drama</option>
                    <option value="Fantasy" {{ request('genre') == 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                    <option value="Horror" {{ request('genre') == 'Horror' ? 'selected' : '' }}>Horror</option>
                    <option value="Mystery" {{ request('genre') == 'Mystery' ? 'selected' : '' }}>Mystery</option>
                    <option value="Science Fiction" {{ request('genre') == 'Science Fiction' ? 'selected' : '' }}>
                        Science Fiction</option>
                    <option value="Family" {{ request('genre') == 'Family' ? 'selected' : '' }}>Family</option>
                </select>
            </div>

            <button type="submit"
                class="w-full px-4 py-2 text-white transition-colors duration-300 bg-blue-500 rounded-lg hover:bg-blue-600">Filter
                Movies</button>
        </div>
    </form>
</div>

<style>
    .range-input input {
        position: absolute;
        width: 100%;
        height: 5px;
        top: -7px;
        background: none;
        pointer-events: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    .range-input input::-webkit-slider-thumb {
        height: 20px;
        width: 20px;
        border-radius: 50%;
        border: 3px solid #3498db;
        background-color: #fff;
        pointer-events: auto;
        -webkit-appearance: none;
        cursor: pointer;
        transition: all 0.15s ease-in-out;
    }

    .range-input input::-webkit-slider-thumb:hover {
        transform: scale(1.2);
    }

    .range-input input::-moz-range-thumb {
        height: 20px;
        width: 20px;
        border-radius: 50%;
        border: 3px solid #3498db;
        background-color: #fff;
        pointer-events: auto;
        -moz-appearance: none;
        cursor: pointer;
        transition: all 0.15s ease-in-out;
    }

    .range-input input::-moz-range-thumb:hover {
        transform: scale(1.2);
    }

    .range-price {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
    }

    .field {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .range-price label {
        font-size: 14px;
        margin-bottom: 5px;
        color: #fff;
    }

    .range-price input {
        width: 80px;
        padding: 8px;
        border: 1px solid #3A4452;
        border-radius: 5px;
        background-color: transparent;
        font-size: 16px;
        text-align: center;
        color: #fff;
        transition: border-color 0.3s;
    }

    .range-price input:focus {
        outline: none;
        border-color: #3498db;
    }
</style>

<script>
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
        range.style.right = 100 - ((maxRange - rangeInput[0].min) / (rangeInput[1].max - rangeInput[1].min)) * 100 +
            "%";
    }

    rangeInput.forEach((input) => {
        input.addEventListener("input", setRange);
    });

    rangePrice.forEach((input) => {
        input.addEventListener("input", (e) => {
            let minPrice = parseInt(rangePrice[0].value);
            let maxPrice = parseInt(rangePrice[1].value);
            if (minPrice < parseInt(rangeInput[0].min)) {
                minPrice = parseInt(rangeInput[0].min);
                rangePrice[0].value = minPrice;
            }
            if (maxPrice > parseInt(rangeInput[1].max)) {
                maxPrice = parseInt(rangeInput[1].max);
                rangePrice[1].value = maxPrice;
            }
            if (maxPrice - minPrice >= rangeMin && maxPrice <= parseInt(rangeInput[1].max)) {
                if (e.target.name === "min_year_display") {
                    rangeInput[0].value = minPrice;
                } else {
                    rangeInput[1].value = maxPrice;
                }
                setRange();
            }
        });
    });

    setRange();

    document.getElementById('filter-form').addEventListener('submit', function(event) {
        const form = event.target;
        const genre = form.querySelector('[name="genre"]').value;
        const minYear = form.querySelector('[name="min_year"]').value;
        const maxYear = form.querySelector('[name="max_year"]').value;

        if (!genre) {
            form.querySelector('[name="genre"]').disabled = true;
        }
        if (minYear === form.querySelector('[name="min_year"]').min && maxYear === form.querySelector(
                '[name="max_year"]').max) {
            form.querySelector('[name="min_year"]').disabled = true;
            form.querySelector('[name="max_year"]').disabled = true;
        }
    });
</script>
