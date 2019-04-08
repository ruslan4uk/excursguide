<?php

namespace App\Http\Controllers\Profile;

use Auth;
use App\User;
use App\Tour;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = Tour::where(['user_id' => Auth::id()])->where('active', 2)->get();

        return view('profile.tours', compact('tours'));
    }

    /**
     * Moderate list
     *
     * @return void
     */
    public function moderate()
    {
        $tours = Tour::where(['user_id' => Auth::id()])->where('active', 1)->get();

        return view('profile.tours', compact('tours'));
    }

    /**
     * Archive list
     *
     * @return void
     */
    public function archive()
    {
        $tours = Tour::where(['user_id' => Auth::id()])->where('active', 999)->get();

        return view('profile.tours', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tour = Tour::create([
            'user_id' => Auth::id()
        ]);

        return redirect()->route('tourEdit', ['id' => $tour->id]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tour = Tour::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

        return view('profile.api_tour', ['tour' => $tour]);
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
