<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->address;
        if ($keyword) {
            $places = Place::where('address', 'LIKE', "%{$keyword}%")->get();
            $addressSuggestions = '<ul class="list-none pl-5 space-y-2">';
            foreach ($places as $place) {
                $addressSuggestions .= '<li class="text-lg font-small text-gray-800 hover:text-blue-500 transition-colors border-b-2 cursor-pointer">' . $place->address . '</li>';
            }
            $addressSuggestions .= '</ul>';
            return response()->json($addressSuggestions);
        }
    }

    public function show(Request $request)
    {
        $keyword = $request->address;
        $category_id = $request->category;
        $places = Place::search($request)->get();
        return view('welcome', compact('places', 'keyword', 'category_id'));
    }
}
