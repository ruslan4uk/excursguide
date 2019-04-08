<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use App\Tour;
use App\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TourController extends Controller
{
    
    /**
     * Tour index
     *
     * @param Int $id
     * @return Object
     */
    public function index($id) 
    {
        
        $tour = Tour::where('id', $id)
                    ->with('user')
                    ->with('userData')
                    ->where('active', 2)
                    // ->whereHas('userData', function($q) use ($id){
                    //     $q->where('active', 1);
                    // })
                    ->firstOrFail();

        return view('frontend.tour', compact('tour'));
    }

}
