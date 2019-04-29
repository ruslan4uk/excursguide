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
        $path  = $request->file->store("uploads", 'public');
        return response()->json(array(
            'file' => '/storage/'. $path,
            'success' => true,
            //'data' => $request->file('file')
        ), 200);
    }
}
