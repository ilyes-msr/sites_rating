<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Place;
use App\Models\Review;
use App\Traits\RateableTrait;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    use RateableTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome', ['places' => Place::orderBy('view_count', 'desc')->take(3)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('add_place', compact('categories'));
    }

    public function store(Request $request) {}

    public function show(Place $place)
    {
        $place = Place::withCount('reviews')->with(['reviews' => function ($query) {
            $query->with('user')
                ->withCount('likes');
        }])->find($place->id);

        $avg = $this->averageRating($place);

        $total = $avg['total'];
        $service_rating = $avg['service_rating'];
        $quality_rating = $avg['quality_rating'];
        $cleanliness_rating = $avg['cleanliness_rating'];
        $pricing_rating = $avg['pricing_rating'];

        return view('details', compact('place', 'total', 'service_rating', 'quality_rating', 'cleanliness_rating', 'pricing_rating'));
    }

    public function edit(Place $place)
    {
        //
    }

    public function update(Request $request, Place $place)
    {
        //
    }

    public function destroy(Place $place)
    {
        //
    }
}
