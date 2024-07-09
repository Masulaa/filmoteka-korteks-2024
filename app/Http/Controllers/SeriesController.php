<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Series::paginate(20);
        return view('series.home', compact('series'));
    }

    public function show(Series $series)
    {
        return view('series.show', compact('series'));
    }


    
    public function action(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');

            $series = Series::where('title', 'like', '%' . $query . '%')
                ->orWhere('creator', 'like', '%' . $query . '%')
                ->orWhere('genre', 'like', '%' . $query . '%')
                ->orderBy('id', 'desc')
                ->take(5)
                ->get();

            $total_row = $series->count();

            if ($total_row > 0) {
                foreach ($series as $show) {
                    $output .= '
                    <li>
                        <a href="' . route('series.show', $show->id) . '" class="flex gap-2">
                                <img width="56px" src="' . $show->image . '" >
                                <div class="flex flex-col">
                                    <h1 class="text-lg font-bold">' . $show->title . '</h1>
                                    <span>' . $show->creator . ' | ' . $show->first_air_date . '</span>
                                    <span>' . '</span>
                                </div>
                        </a>
                    </li>';
                }
            } else {
                $output = '
                <tr>
                    <td colspan="3">No series found</td>
                </tr>';
            }

            $data = array(
                'html' => $output,
                'total' => $total_row
            );

            return response()->json($data);
        }
    }

    public function filter(Request $request)
    {
        try {
            $query = Series::query();
    
            if ($request->filled('genre')) {
                $query->where('genre', 'like', '%' . $request->genre . '%');
            }
    
            if ($request->filled('min_year') && $request->filled('max_year')) {
                $query->whereYear('first_air_date', '>=', $request->min_year)
                      ->whereYear('first_air_date', '<=', $request->max_year);
            }
    
            $series = $query->paginate(20)->appends($request->except('page'));
    
            if ($request->ajax()) {
                return view('series.serieslist', compact('series'))->render();
            }
    
            return view('series.home', compact('series'));
        } catch (\Exception $e) {
            Log::error('Series filter error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'An error occurred while filtering series: ' . $e->getMessage()], 500);
        }
    }

    public function watch($id)
    {
        $series = Series::find($id);

        if (!$series) {
            abort(404); 
        }

        return view('series.watch', compact('series'));
    }
}