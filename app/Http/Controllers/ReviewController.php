<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        if ($request->user()->reviews()->wherePlace_id($request->place_id)->exists()) {
            return redirect(url()->previous() . '#review-div')->with('fail', 'لقد قيّمت هذا الموقع مُسبقاً');
        }
        $review = Review::create($request->all() + ['user_id' => auth()->id()]);
        return redirect(url()->previous() . '#review-div')->with('success', 'تمّ بنجاح إضافة مراجعة');
    }
}
