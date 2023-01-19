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
                    $newimage = "multi_images/multi_image.".$image->getClientOriginalName();
                    //hexdec(uniqid()).'.'.$newimage;
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
            "message"=>"Please slect images"
        ];
        return redirect()->back()->with($noti);


    }

    //show all images
    public function AllMultiImage(){

        $allMultiImage = MultiImge::all();
        return view('admin.about_page.all_multi_image',compact('allMultiImage'));

     }

     //edit multi image

     public function editMultiImage(MultiImge $multiimage){
        return view('admin.about_page.edit_multi_image',compact('multiimage'));
        
     }

     //update mulit image

     public function updateMultiImage(Request $request,MultiImge $multiimage){
        $image = $request->file('multi_image');

        if($request->hasFile('multi_image')){
                $newimage = "multi_images/update/multi_image.".$image->getClientOriginalName();
                $image->storeAs('public',$newimage);
               MultiImge::insert(["multi_image"=>$newimage]);
            $noti = [
                "error"=>false,
                "message"=>"Multi Image updated Successfully"
            ];    
    return redirect()->route('all.multi.image')->with($noti);
        
     }
    }
}
