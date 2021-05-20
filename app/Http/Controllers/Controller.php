<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $user = Auth::user();
        $address = Address::find($request->address)->first();

        $review = Review::create([
            'title' => $request->review['title'],
            'summary' => $request->review["summary"],
            'address_id' => $address->id,
            'user_id' => 1
        ]);
        $review->save();

        $rating = Rating::create([
            "landlord" =>  $request->rating["landlord"],
            "premise" =>  $request->rating["premise"],
            "area" =>  $request->rating["area"],
            "transport" =>  $request->rating["transport"],
            "noise" =>  $request->rating["noise"],
            "overall" =>  ($request->rating["landlord"] + $request->rating["premise"] + $request->rating["area"] + $request->rating["transport"] + $request->rating["noise"]) / 5,
            'review_id' => $review->id
        ]);
        $rating->save();
    }
}
