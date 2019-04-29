<?php

namespace App\Http\Controllers\ApiV2\Search;

use App\Geodata\Cities;
use App\Http\Resources\Cities as CitiesResource;
use App\Geodata\Countries;
use App\Http\Resources\Countries as CountriesResource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeoController extends Controller
{
    public function getCountry() {
        return response()->json([
            'success' => true,
            'data' => CountriesResource::collection(Countries::all())
        ]);
    }

    public function getCity(Request $request) {
        $request->validate([
            'q' => ['required', 'string', 'max:10']
        ]);

        return response()->json([
            'success' => true,
            'data' => CitiesResource::collection(
                    Cities::where('city', '!=', '')->where('city_iso_code', $request->get('q'))->get()
                )
        ]); 
    }
}
