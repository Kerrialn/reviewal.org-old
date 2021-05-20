<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $review = new Rating();
    $review->landlord = $request->landlord;
    $review->premise = $request->premise;
    $review->area = $request->area;
    $review->transport = $request->transport;
    $review->noise = $request->noise;
    $review->save();

    return $review;
  }
}
