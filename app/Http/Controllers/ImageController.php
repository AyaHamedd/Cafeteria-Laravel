<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function upload(Request $request){
        $file = $request->file('avatar');
        $name = Str::random(10);
        $url = \Storage::putFileAs('images', $file, $name.'.'.$file->extension());

        return ['url'=>env('APP_URL').'/'.$url];
    }
}
