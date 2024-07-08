<div class="flex flex-col items-center justify-center my-4">
    <div class="relative w-208">
        <div class="absolute inset-y-0 right-0 flex items-center h-full pr-3" style="margin-right: 4px;">
            <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
<div class="flex flex-col items-center justify-center mt-4">
    <div class="relative w-80">
        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
        <input type="text" id="search"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 pl-10 pr-8 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Search..." required />
    </div>
    <div class="text-slate-800 dark:text-white">
        <ul id="movie_data" class="flex flex-col gap-3 p-4 max-w-96">
        </ul>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        <div id="movie_results"
            class="absolute left-0 right-0 z-10 overflow-hidden bg-white rounded-b-lg shadow-lg top-full dark:bg-gray-800"
            style="display: none;">
            <ul id="movie_data" class="flex flex-col gap-3 p-4 max-w-96 text-slate-800 dark:text-white">
            </ul>
        </div>
    </div>
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

        $(document).on('keyup', '#search', function () {
            var query = $(this).val().trim();
            fetch_movie_data(query);
        });

        fetch_movie_data();
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
