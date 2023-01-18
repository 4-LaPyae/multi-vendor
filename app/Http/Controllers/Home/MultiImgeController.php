<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MultiImge;

class MultiImgeController extends Controller
{
    public function aboutMultiImage(){
        return view('admin.about_page.multi_image');
    }

    public function storeMultiImage(Request $request){
        $images = $request->file('multi_image');
        if($request->hasFile('multi_image')){
                foreach($images as $image){
                    $newimage = "storage/multi_image.".$image->getClientOriginalName();
                    $image->storeAs('public',$newimage);
                   MultiImge::insert(["multi_image"=>$newimage]);
                }
                $noti = [
                    "error"=>false,
                    "message"=>"Multi Image Inserted Successfully"
                ];
            
        
        return redirect()->back()->with($noti);
        }
        $noti = [
            "error"=>false,
            "message"=>"Please slect image"
        ];
        return redirect()->back()->with($noti);


    }
}
