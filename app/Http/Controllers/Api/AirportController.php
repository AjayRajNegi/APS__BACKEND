<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allAirports()
    {
        return Airport::latest()->get();
    }

    public function country()
    {
        $countries = Airport::select('country')->distinct()->pluck('country');

        return response()->json($countries);
  
    }

    public function byCountry($country)
    {
        $airport = Airport::where('country',$country)->latest()->take(5)->get();

        return response()->json($airport);
       
    }

    public function airport($id)
    {
        $airport = Airport::find($id);

        if (!$airport) {
            return response()->json(['message' => 'Airport not found'], 404);
        }
        return response()->json($airport);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
