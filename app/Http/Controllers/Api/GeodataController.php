<?php

namespace App\Http\Controllers\Api;

use App\Geodata\Cities;
use App\Geodata\Countries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeodataController extends Controller
{
    public function index(Request $request)
    {
        if($request->get('q')) {
            return Cities::WhereRaw("MATCH(city.city) AGAINST('" . $request->get('q') . "*' IN BOOLEAN MODE)")
                    ->limit(25)
                    ->select('city.id','city.city','city.city_iso_code','city.region', 'country.country_name')
                    ->join('country', 'country.country_iso_code', '=', 'city.city_iso_code')
                    ->get();
        }
        if($request->get('id')) {
            return Cities::where('id', $request->get('id'))
                    ->limit(25)
                    ->select('city.id','city.city','city.city_iso_code','city.region', 'country.country_name')
                    ->join('country', 'country.country_iso_code', '=', 'city.city_iso_code')
                    ->first();
        }
        if($request->get('ids')) {
            $ids = json_decode($request->get('ids'), true);
            $output = [];
            foreach($ids as $cid) {
                $output[] = Cities::where('id', $cid)
                        ->limit(25)
                        ->select('city.id','city.city','city.city_iso_code','city.region', 'country.country_name')
                        ->join('country', 'country.country_iso_code', '=', 'city.city_iso_code')
                        ->first();
            }
            return response()->json($output);
        }
    }

}
