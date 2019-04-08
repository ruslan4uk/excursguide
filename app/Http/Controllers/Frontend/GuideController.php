<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuideController extends Controller
{
    public function index($id) {

        $guide = User::where('id', $id)
                    ->with('userData')
                    ->firstOrFail();

        $comments = \App\Comment::where('page_id', $id)
                    ->with('user')
                    ->with('userData')
                    ->get();

        return view('frontend.guide', compact('guide', 'comments'));
    }


    /**
     * Create comment
     *
     * @param [type] $id
     * @param Request $request
     * @return void
     */
    public function addComment($id, Request $request) {

        // Validate
        $request->validate([
            'comment' => ['required', 'min:50', 'max:1000'],
        ]);

        $result = \App\Comment::create([
            'user_id' => Auth::id(),
            'page_id' => $id,
            'text' => $request->get('comment'),
        ]);

        return back();
    }
}
