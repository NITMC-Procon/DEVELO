<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;


class ImageController extends Controller
{
    //
    public function upload(Request $request)
    {
        //$request->file('img')に画像を受け取った
        $image_name = $request->file('img')->getClientOriginalName();
        $image_info = pathinfo($image_name,PATHINFO_EXTENSION);

        //拡張子確認
        $mimes = ["png","jpeg","jpg"];
        if(! in_array($image_info,$mimes))return ["0"=>-1];

        $image = new Image();
        $image->user_id = Auth::user()->id;
        $image->name = $image_name;
        $image->referenced_by = "" .  strlen(Auth::user()->id) .  Auth::user()->id . $request->referenced;
        $image->save();

        $latest_image_id = Image::where('user_id',Auth::user()->id)
                            ->latest()
                            ->first('id')["id"];
        

        Storage::putFileAs('public/Images/',$request->file('img'),$latest_image_id.'.'.$image_info);
        
        return ["0"=>$latest_image_id,"1"=>$image_info];
    }
}
