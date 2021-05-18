<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Rating;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function search(Request $request)
    {

        $lineOne = strtolower($request->input('lineOne'));
        $lineTwo = strtolower($request->input('lineTwo')) ?? '';
        $district = strtolower($request->input('district')) ?? '';
        $city = strtolower($request->input('city')) ?? '';
        $postalCode = strtolower($request->input('postalCode')) ?? '';
        $countryCode = strtolower($request->input('countryCode')) ?? '';

        if ($lineOne) {
            $addresses = Address::where('line_one', 'LIKE', '%' . $lineOne . '%');
        }

        if ($lineTwo) {
            $addresses->where('line_two', 'LIKE', '%' . $lineTwo . '%');
        }

        if ($district) {
            $addresses->where('district', '=', $district);
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
                'lineOne' => $lineOne,
                'lineTwo' => $lineTwo,
                'district' => $district,
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
        $address = new Address;
        $address->line_one  = strtolower($request->lineOne);
        $address->line_two  = strtolower($request->lineTwo);
        $address->district  = strtolower($request->district);
        $address->city  = strtolower($request->city);
        $address->postal_code  = strtolower($request->postalCode);
        $address->country_code = strtolower($request->countryCode);
        $address->save();

        return $address;
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
