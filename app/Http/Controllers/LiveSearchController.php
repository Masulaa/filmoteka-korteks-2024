<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LiveSearchController extends Controller
{
    public function index()
    {
        return view('livesearch'); // Replace 'livesearch' with your actual view name
    }

    public function action(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = DB::table('movies')
                    ->where('title', 'like', '%' . $query . '%')
                    ->orWhere('director', 'like', '%' . $query . '%')
                    ->orWhere('genre', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                $data = DB::table('movies')
                    ->orderBy('id', 'desc')
                    ->get();
            }

            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $movie) {
                    $output .= '
                    <div class="relative group">
                        <div class="w-full overflow-hidden bg-gray-200 rounded-md aspect-h-1 aspect-w-1 lg:aspect-none group-hover:opacity-75 lg:h-80">
                            <img src="' . $movie->image . '" alt="' . $movie->title . '" class="object-cover object-center w-full h-full lg:h-full lg:w-full">
                        </div>
                        <div class="flex justify-between mt-4">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a href="' . route('movie', $movie->id) . '">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        ' . $movie->title . '
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">' . $movie->genre . '</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">' . $movie->director . '</p>
                        </div>
                    </div>
                    ';
                }
            } else {
                $output = '
                <div class="py-4 text-center text-gray-500">
                    No movies found.
                </div>
                ';
            }
            $data = array(
                'html' => $output,
                'total' => $total_row
            );
            return response()->json($data);
        }
    }
}
