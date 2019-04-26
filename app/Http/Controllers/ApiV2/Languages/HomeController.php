<?php

namespace App\Http\Controllers\ApiV2\Languages;

use App\Language;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Language::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'iso_code' => ['required', 'string', 'max:255'],
        ]);

        $lang = Language::updateOrCreate(['iso_code' => $request->get('iso_code')], $request->only(['name', 'iso_code', 'active']));

        if($lang) {
            return response()->json([
                'success' => true,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$id) {
            return false;
        }
        $lang = Language::find($id);

        if($lang->delete()) {
            return response()->json([
                'success' => true
            ]);
        }
    }
}
