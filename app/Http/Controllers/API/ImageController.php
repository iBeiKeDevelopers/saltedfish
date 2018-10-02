<?php

namespace App\Http\Controllers\API;

use App\Models\Image;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $gid)
    {
        $images = Image::where('gid', $gid)->get();
        return $images;
    }

    /**
     * Cache all the images of the good
     */
    public function cache(int $gid)
    {
        $images = Image::where('gid', $gid)->get();

        $list = [];
        foreach($images as $item) {
            $path = $item->path;
            $img = Storage::get($path);
            //Storage::delete($path);

            $key = uniqid('image_');
            $ext = substr(strrchr($path, '.'), 1);
            cache([$key => [$img, $ext]], 30);
            array_push($list, $key);
        }
        return [
            'images' => $list,
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        if(!$file->isValid())
            abort(403, "upload failed!");

        $ext = $file->getClientOriginalExtension();
        if(!isLegalExt($ext)) return [
            'status'    =>      false,
            'error'     =>      'invalid extension',
        ];
        
        $path = $file->store('public/tmp');
        $img = Storage::get($path);
        Storage::delete($path);

        $key = uniqid('image_');
        cache([$key => [$img, $ext]], 30);
        return [
            'name' => $key,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {
        if(starts_with($key, 'image_'))
            return cache($key)[0];
        else
            abort(500, "not image!");
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
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function destroy($key)
    {
        Cache::forget($key);
    }
}

function isLegalExt($ext) {
    $arr = [
        'jpg', 'jpeg', 'png',
    ];
    if(in_array($ext, $arr))
        return true;
    else return false;
}
