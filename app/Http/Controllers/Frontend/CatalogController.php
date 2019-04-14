<?php

namespace App\Http\Controllers\Frontend;

use App\Tour;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    /**
     * Tours view
     *
     * @param [type] $id
     * @return void
     */
    public function tours ($id) 
    {
        $tours = Tour::where('location', $id)->where('active', 2)->get();

        $categories = \App\Category::all();

        return view('frontend.catalog.tours', compact('tours', 'id', 'categories'));
    }

    /**
     * Category view
     *
     * @param [type] $id
     * @return void
     */
    public function category ($id, $category) 
    {
        $tours = Tour::where('location', $id)
                    ->where('active', 2)    
                    ->where('category', $category)
                    ->get();

        $categories = \App\Category::all();

        return view('frontend.catalog.tours', compact('tours', 'id', 'categories'));
    }

    /**
     * Guides view
     *
     * @param [type] $id
     * @return void
     */
    public function guides ($id) 
    {
        $guides = User::with('userData')
                        ->with('activeTours')
                        ->whereHas('userData', function($q) use ($id){
                            $q->where('locations', 'LIKE', '%'. $id .'%');
                        })
                        ->whereHas('userData', function($q) use ($id){
                            $q->where('active', 1);
                        })
                        ->get();

        return view('frontend.catalog.guides', compact('guides', 'id'));
    }
}
