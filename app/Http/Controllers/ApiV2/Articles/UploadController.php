<?php

namespace App\Http\Controllers\ApiV2\Articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Storage;
use Intervention\Image\Facades\Image;

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

    public function uploadAvatar(Request $request) {

        $request->validate([
            'page_id' => ['required', 'numeric'],
            'avatar' => ['dimensions:min_width=1000,min_height=600']
        ]);

        $avatar_crop = Image::make($request->file('avatar'))->fit(400, 400)->encode('jpg');
        $avatar = Image::make($request->file('avatar'))->fit(1200, 500)->encode('jpg');
        
        $path = "uploads/articles/" . $request->get('page_id');

        if(Storage::disk('public')->put($path . '/avatar.jpg', (string) $avatar)
            && Storage::disk('public')->put($path . '/avatar_crop.jpg', (string) $avatar_crop)) 
        {
            return response()->json([
                'success' => true,
                'data' => [
                    'avatar' => 'http://localhost:8000/storage/' . $path . "/avatar.jpg",
                    'avatar_crop' => 'http://localhost:8000/storage/' . $path . "/avatar_crop.jpg"
                ]
            ], 200);
        }
    }

    public function upload(Request $request) {
        
        $request->validate([
            'page_id' => ['required', 'numeric'],
            'file' => ['dimensions:min_width=1000,min_height=600']
        ]);

        $path = $request->file->store("uploads/articles/" . $request->get('page_id'), 'public');

        return response()->json(array(
            'file' => 'http://localhost:8000/storage/'. $path,
            'success' => true,
        ), 200);
    }
}
