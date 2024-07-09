<div class="flex items-center justify-center mt-4">
    <div class="flex flex-col items-center justify-center ">
        <div class="relative w-80">
            <div class="absolute inset-y-0 flex items-center justify-between pointer-events-none start-0 ps-3">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>

            </div>
            <input type="text" id="search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-s-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full py-2.5 pl-10 pr-8 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-700 dark:focus:border-indigo-700"
                placeholder="Search..." required />

            <div id="movie_results"
                class="absolute left-0 right-0 z-10 overflow-hidden bg-white rounded-b-lg shadow-lg top-full dark:bg-gray-800"
                style="display: none;">
                <ul id="movie_data" class="flex flex-col gap-3 p-4  max-w-96 text-slate-800 dark:text-white">
                </ul>
            </div>
        </div>
    </div>
    <button onclick="toggleFilter()" class="px-5 py-3 bg-indigo-700 rounded-r-lg">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M3 1L3 11M3 11C1.89543 11 1 11.8954 1 13C1 14.1046 1.89543 15 3 15M3 11C4.10457 11 5 11.8954 5 13C5 14.1046 4.10457 15 3 15M3 15L3 17M9 1V3M9 3C7.89543 3 7 3.89543 7 5C7 6.10457 7.89543 7 9 7M9 3C10.1046 3 11 3.89543 11 5C11 6.10457 10.1046 7 9 7M9 7V17M15 1V11M15 11C13.8954 11 13 11.8954 13 13C13 14.1046 13.8954 15 15 15M15 11C16.1046 11 17 11.8954 17 13C17 14.1046 16.1046 15 15 15M15 15V17"
                stroke="white" stroke-width="2" stroke-linecap="round" />
        </svg>

    </button>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function fetch_movie_data(query = '') {
            if (query === '') {
                $('#movie_data').html('');
                $('#movie_results').hide();
                return;
            }
            $.ajax({
                url: "{{ route('action') }}",
                method: 'GET',
                data: {
                    query: query
                },
                dataType: 'json',
                success: function(data) {
                    $('#movie_data').html(data.html);
                    $('#movie_results').show();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        $(document).on('keyup', '#search', function() {
            var query = $(this).val().trim();
            fetch_movie_data(query);
        });

        $(document).on('click', function(event) {
            if (!$(event.target).closest('#movie_results, #search').length) {
                $('#movie_results').hide();
            }
        });

        $('#search').on('focus', function() {
            if ($('#movie_data').html().trim() !== '') {
                $('#movie_results').show();
            }
        });
    });
</script>
