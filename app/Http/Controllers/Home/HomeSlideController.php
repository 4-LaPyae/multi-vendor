<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HomeSlide;

class HomeSlideController extends Controller
{
    public function HomeSlider(){

        $homeslide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all',compact('homeslide'));

     }

     public function updateSlide(Request $request){
        $homeslide = HomeSlide::find($request->id);     
        $homeslide->title = $request->title;
        $homeslide->short_title = $request->short_title;
        $homeslide->video_url = $request->video_url;

        if($request->hasFile('home_slide')){
            $newimage = "home_slide.".$request->file('home_slide')->getClientOriginalName();
            $request->file('home_slide')->storeAs('public',$newimage);
            $homeslide->home_slide = $newimage;
            $homeslide->save();
        $noti = [
            "error"=>false,
            "message"=>"Home Slide Updated with Image Successfully"
        ];
        return redirect()->back()->with($noti);
        }else{
            $noti = [
                "error"=>false,
                "message"=>"Home Slide Updated without Image Successfully"
            ];
            return redirect()->back()->with($noti);

        }   
     }
}
