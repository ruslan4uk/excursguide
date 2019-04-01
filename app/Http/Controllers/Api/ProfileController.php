<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\User;
use App\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', Auth::id())->with('userData')->first();
        
        return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //return $request->get('user_data');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // UserData
            'user_data.languages'           => ['required'], 
            'user_data.locations'           => ['required'],
            'user_data.contacts.*.value'      => ['required'],
            'user_data.contacts.*.type_id'    => ['required'],
            'user_data.services'            => ['required'],
            'user_data.about'               => ['required', 'string', 'min:50', 'max:255'],
        ]);

        $user = User::where('id', Auth::id())->with('userData')->first();
        $user->update([
            'name' => $request->get('name'),
        ]);
        
        $user->userData()->update([
            'languages'     => json_encode($request->get('user_data')['languages']),
            'locations'     => json_encode($request->get('user_data')['locations']),
            'contacts'      => json_encode($request->get('user_data')['contacts']),
            'services'      => json_encode($request->get('user_data')['services']),
            'about'         => $request->get('user_data')['about'],
        ]);

        return response()->json(['messages' => 'Профиль успешно обновлен']);
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
        //
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


    /**
     * Uploader user avatar
     *
     * @param Request $request
     * @return void
     */
    private $image_ext = ['jpg', 'jpeg', 'png', 'gif'];
    public function avatar (Request $request) 
    {
        $max_size = (int)ini_get('upload_max_filesize') * 500000;
        $all_ext = implode(',', $this->image_ext);
        $this->validate($request, [
            'file' => 'required|file|mimes:' . $all_ext . '|max:' . $max_size
        ]);
        $image = Image::make($request->file('file'))->fit(400, 400)->encode('jpg');
        
        if(Storage::disk('public')->put('users/' . Auth::id() . '/avatar.jpg', (string) $image))
        {
            $user = User::where('id', Auth::id())->with('userData')->first();
            $user->userData()->update([
                'avatar' => 'storage/users/' . Auth::id() . '/avatar.jpg',
            ]);
            $user->save();

            return 'storage/users/' . Auth::id() . '/avatar.jpg';
        }
    }


    /**
     * License Uploader
     * TODO: Validation
     *
     * @param Request $request
     * @return void
     */
    public function uploadLicense(Request $request) {

        $user = User::where('id', Auth::id())->with('userData')->firstOrFail();
        $user_data = json_decode($user, true);
        $user_files = $user_data['user_data']['user_files'];

        $i = 0;
        $path = [];
        foreach ($request->file('files') as $file) {
            $i++;
            $image = Image::make($file)->encode('jpg');
            if(Storage::disk('public')->put('users/' . Auth::id() . '/license/' . md5($i . time()). '.jpg', (string) $image))
            {
                $path[$i]['path'] = 'storage/users/' . Auth::id() . '/license/' . md5($i . time()) . '.jpg';
                $path[$i]['filename'] = md5($i . time()). '.jpg';
            }
            $license = array_merge($user_files, $path);
        }
        
        $user->userData()->update([
            'user_files' => json_encode($license),
        ]);

        return response()->json($license);



        // if($request->get('id') >= 0 && is_numeric($request->get('id'))) {
        //     Storage::disk('public')->delete('users/' . Auth::id() . '/license/' . $user_files[$request->get('id')]->filename);
        //     \array_splice($user_files, $request->get('id'), 1);
        //     $user_data->user_files = json_encode($user_files);
        //     $user_data->save();
        //     return \response()->json($user_files);
        // }
        // $i = 0;
        // $path = [];
        // foreach ($request->file('files') as $file) {
        //     $i++;
        //     $image = Image::make($file)->encode('jpg');
        //     if(Storage::disk('public')->put('users/' . Auth::id() . '/license/' . md5($i . time()). '.jpg', (string) $image))
        //     {
        //         $path[$i]['path'] = 'storage/users/' . Auth::id() . '/license/' . md5($i . time()) . '.jpg';
        //         $path[$i]['filename'] = md5($i . time()). '.jpg';
        //     }
        //     $license = array_merge($user_files, $path);
        // }    
        //$license = $user_data->user_files ? array_merge($user_files, $path) : $path;
        // $user_data->user_files = json_encode($license);
        // $user_data->save();
        // return response()->json($license);    
    }

    public function deleteLicense (Request $request) {

        $user = User::where('id', Auth::id())->with('userData')->firstOrFail();
        $user_data = json_decode($user, true);
        $user_files = $user_data['user_data']['user_files'];

        if($request->get('id') >= 0 && is_numeric($request->get('id'))) {
            Storage::disk('public')->delete('users/' . Auth::id() . '/license/' . $user_files[$request->get('id')]['filename']);
            \array_splice($user_files, $request->get('id'), 1);

            $user->userData()->update([
                'user_files' => json_encode($user_files),
            ]);
            // $user_files = json_encode($user_files);
            // $user_data->save();
            return response()->json($user_files);
        }

    }

}
