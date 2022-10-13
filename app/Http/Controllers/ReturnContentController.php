<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReturnContent;

class ReturnContentController extends Controller
{
    //
    public function store(Request $file)
    {
        $reference_id = "" . strlen(Auth::user()->id) . Auth::user()->id . $request->date;
        $return_content = new ReturnContent;
        $return_content->reference_id = $reference_id;
        $return_content->
        Storage::putFileAs('/return/',$request->file('img'),$latest_image_id.'.'.$image_info);
    
    }
}
