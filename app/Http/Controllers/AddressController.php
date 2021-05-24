<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Rating;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function search(Request $request)
    {

        $premise = strtolower($request->input('premise'));
        $floor = $request->input('floor');
        $lineOne = strtolower($request->input('lineOne'));
        $city = strtolower($request->input('city'));
        $postalCode = strtolower($request->input('postalCode'));
        $countryCode = strtolower($request->input('countryCode'));

        if ($premise) {
            $addresses = Address::where('premise', '=', $premise);
        }

        if ($floor) {
            $addresses->where('floor', '=', $floor);
        }

        if ($lineOne) {
            $addresses->where('line_one', 'LIKE', '%' . $lineOne . '%');
        }

        if ($city) {
            $addresses->where('city', 'LIKE', '%' . $city . '%');
        }

        if ($postalCode) {
            $addresses->where('postal_code', '=', $postalCode);
        }

        if ($countryCode) {
            $addresses->where('country_code', 'LIKE', $countryCode);
        }

        $addresses->limit(10);

        return [
            'search' => [
                'premise' => $premise,
                'floor' => $floor,
                'lineOne' => $lineOne,
                'city' => $city,
                'postalCode' => $postalCode,
                'countryCode' => $countryCode,
            ],
            'addresses' => $addresses->get(),
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Address::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'premise'  => 'required',
            'floor'  => 'required|int',
            'line_one'  => 'required|string',
            'city'  => 'required|string',
            'postal_code'  => 'required|string',
            'country_code' => 'required|string',
        ]);

        if (!$validate) {
            abort(400, 'form invalid');
        }

        $address = Address::firstOrCreate([
            'premise'  => $request->premise,
            'floor'  => $request->floor,
            'line_one'  => strtolower($request->line_one),
            'city'  => strtolower($request->city),
            'postal_code'  => strtolower($request->postal_code),
            'country_code' => strtolower($request->country_code),
        ]);
        $address->save();
        return response($address);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $Address
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Address::with('reviews')->find($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $Address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $address->title = $request->title;
        $address->summary = $request->summary;
        $address->save();

        return $address;
    }
}
