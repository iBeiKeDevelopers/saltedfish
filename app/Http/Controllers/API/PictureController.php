<?php

namespace App\Http\Controllers\API;

use App\Models\Picture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('image');
        if(!$file->isValid()) abort(403, "upload failed!");

        $originalName = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $type = $file->getClientMimeType();
        $realPath = $file->getRealPath();
        $filename = date('H:i').'-'.uniqid().'.'.$ext;
        
        Storage::disk('public')->put($filename, file_get_contents($realPath));
        $url = Storage::url($filename);
        DB::table('picture')->updateOrNew([
            'src'   =>      $url,
        ]);
        return $url ?? abort(500);
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
}