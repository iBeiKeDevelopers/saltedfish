<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\InputController;
use App\Models\Picture as PictureModel;
use App\Http\Resources\Picture as PictureResource;

class PictureUploadController extends Controller
{
    private $picture;
    //
    public function __construct() {
        $this->picture = new PictureModel;
    }

    public function picture_upload(Request $request) {
        $pic = Route::file('picture');
        $type = $request->input('type', 'goodsProfile');
        
        $dir = $this->picture->get_path($pic, $type);
        $name = $this->picture->get_name($pic);
        if(!$name) {
            return Report::throw('picture not allowed');
        }

        $pic->move($dir, $name);
        if(PictureModel::create([
            'src'   =>      $dir,
            'alt'   =>      $name,
        ])) { return $dir . $name; }
        else {
            return Report::throw('failed to create new picture.');
        }
    }
}
