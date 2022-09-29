<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function single($id)
    {
        $review = Review::where('id',$id)->first();
        return response([
            'status'=> true,
            'data'=> $review,
        ]);
    }
    public function byWorksop($workshop_id)
    {
        $reviews = Review::where('workshop_id',$workshop_id)->get();
        return response([
            'status'=> true,
            'data'=> ReviewResource::collection($reviews),
        ]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'workshop_id' => 'required',
            'booking_id' => 'required',
            'rating' => 'required',
            'comments' => 'required',
        ]);

        $review = new Review;
        $review->user_id = $request->user_id;
        $review->workshop_id = $request->workshop_id;
        $review->booking_id = $request->booking_id;
        $review->rating = $request->rating;
        $review->comments = $request->comments;
        $review->save();
        return response([
            'status'=> true,
            'data'=> ReviewResource::make($review),
        ]);
    }
}
