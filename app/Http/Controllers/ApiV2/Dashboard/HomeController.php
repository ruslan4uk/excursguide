<?php

namespace App\Http\Controllers\ApiV2\Dashboard;

use App\User;
use App\UserData;
use App\Tour;
use App\Comment;
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


    public function index() 
    {
        // Counter
        $guideCount = UserData::count();
        $tourCount = Tour::count();
        $commentCount = Comment::count();

        // First 10 user
        $firstUser = User::limit(10)->with('userData')->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => compact([
                'tourCount', 
                'guideCount', 
                'commentCount',
                'firstUser'
            ],200),
        ]);
    }
}
