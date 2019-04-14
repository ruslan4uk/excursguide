<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\User;
use App\Tour;

use Storage;
use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TourController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        
        $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'location'          => ['required'],
            'route'             => ['required'],
            'languages'         => ['required'],
            // TODO: other 1
            'category'          => ['required'],
            'people_category'   => ['required'],
            'people_count'      => ['required'],
            'timing'            => ['required'],
            'price'             => ['required'],
            'currency'          => ['required'],
            'price_type'        => ['required'],
            'services'          => ['required'],
            'other_rate'        => ['required'],
            'other_item'        => ['required'],
            'about'             => ['required', 'string', 'min:50', 'max:2000'],
        ]);

        $tour = Tour::where('user_id', Auth::id())->where('id', $id)->update([
            'name'              => $request->get('name'),
            'location'          => $request->get('location'),
            'route'             => $request->get('route'),
            'languages'         => json_encode($request->get('languages')),
            // TODO: other 1
            'category'          => $request->get('category'),
            'people_category'   => $request->get('people_category'),
            'people_count'      => $request->get('people_count'),
            'timing'            => $request->get('timing'),
            'price'             => $request->get('price'),
            'currency'          => $request->get('currency'),
            'price_type'        => $request->get('price_type'),

            'services'          => $request->get('services'),
            'other_rate'        => $request->get('other_rate'),
            'other_item'        => $request->get('other_item'),
            'about'             => $request->get('about'),

            'active'            => 2,
        ]);



        return response()->json(['messages' => 'Экскурсия успешно сохранена']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tour = Tour::where('user_id', Auth::id())
                        ->where('id', $id)
                        ->firstOrFail();

        return response()->json($tour);
    }

    /**
     * Uploader tour avatar
     *
     * @param Request $request
     * @return void
     */
    private $image_ext = ['jpg', 'jpeg', 'png', 'gif'];
    public function avatar (Request $request) 
    {

        //return response()->json($request->get('id'));

        $max_size = (int)ini_get('upload_max_filesize') * 500000;
        $all_ext = implode(',', $this->image_ext);
        $this->validate($request, [
            'file' => 'required|file|mimes:' . $all_ext . '|max:' . $max_size
        ]);
        $image = Image::make($request->file('file'))->fit(400, 400)->encode('jpg');
        
        if(Storage::disk('public')->put('users/' . Auth::id() . '/tour/' . $request->get('id') . '/avatar.jpg', (string) $image))
        {
            $tour = Tour::where('user_id', Auth::id())
                ->where('id', $request->get('id'))
                ->update([
                    'avatar' => '/storage/users/' . Auth::id() . '/tour/' . $request->get('id') . '/avatar.jpg',
                ]);
                
            return '/storage/users/' . Auth::id() . '/tour/' . $request->get('id') . '/avatar.jpg';
        }
    }





    /**
     * Photo Uploader
     * TODO: Validation and rename
     *
     * @param Request $request
     * @return void
     */
    public function uploadLicense(Request $request) {

        $tour = Tour::where('user_id', Auth::id())->where('id', $request->get('id'))->firstOrFail();
        $tour_photo = $tour->photo
                        ? $tour->photo
                        : [];

        $i = 0;
        $path = [];
        foreach ($request->file('files') as $file) {
            $i++;
            $image = Image::make($file)->encode('jpg');
            $crop = Image::make($file)->fit(1200, 705)->encode('jpg');
            if(Storage::disk('public')->put('users/' . Auth::id() . '/tour/' . $request->get('id') . '/'. md5($i . time()). '.jpg', (string) $image)
            && Storage::disk('public')->put('users/' . Auth::id() . '/tour/' . $request->get('id') . '/'. md5($i . time()). '_crop.jpg', (string) $crop))
            {
                $path[$i]['path'] = '/storage/users/' . Auth::id() . '/tour/' . $request->get('id') . '/'. md5($i . time()) . '.jpg';
                $path[$i]['crop'] = '/storage/users/' . Auth::id() . '/tour/' . $request->get('id') . '/'. md5($i . time()) . '_crop.jpg';
                $path[$i]['filename'] = md5($i . time()). '.jpg';
                $path[$i]['filename_crop'] = md5($i . time()). '_crop.jpg';
            }
            $license = array_merge($tour_photo, $path);
        }
        
        Tour::where('user_id', Auth::id())->where('id', $request->get('id'))->update([
            'photo' => json_encode($license),
        ]);

        return response()->json($license);
    }

    public function deleteLicense (Request $request) 
    {
        $tour = Tour::where('user_id', Auth::id())->where('id', $request->get('tour_id'))->firstOrFail();
        $tour_photo = $tour->photo;

        if($request->get('id') >= 0 && is_numeric($request->get('id'))) {
            Storage::disk('public')->delete('users/' . Auth::id() . '/tour/' . $request->get('tour_id') . '/'. $tour_photo{$request->get('id')}->filename);
            Storage::disk('public')->delete('users/' . Auth::id() . '/tour/' . $request->get('tour_id') . '/'. $tour_photo{$request->get('id')}->filename_crop);
            \array_splice($tour_photo, $request->get('id'), 1);
 
            Tour::where('user_id', Auth::id())->where('id', $request->get('tour_id'))->update([
                'photo' => json_encode($tour_photo),
            ]);
            return response()->json($tour_photo);
        }

    }

}
