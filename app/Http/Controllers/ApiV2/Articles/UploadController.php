<?php

namespace App\Http\Controllers\ApiV2\Articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
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

    public function upload(Request $request) {
        $request->validate([
            'page_id' => ['required', 'numeric'],
            'file' => ['dimensions:min_width=1000,min_height=600']
        ]);

        $path  = $request->file->store("uploads/articles/" . $request->get('page_id'), 'public');

        return response()->json(array(
            'file' => 'http://localhost:8000/storage/'. $path,
            'success' => true,
        ), 200);
    }
}
