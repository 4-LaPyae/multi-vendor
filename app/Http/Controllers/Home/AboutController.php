<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\About;

class AboutController extends Controller
{
    //for backend about page in dashboard
    public function aboutPage(){

        $aboutpage = About::find(1);
        return view('admin.about_page.about_page_all',compact('aboutpage'));

     }

     public function updateAbout(Request $request){
        $aboutpage = About::find($request->id);     
        $aboutpage->title = $request->title;
        $aboutpage->short_title = $request->short_title;
        $aboutpage->short_description = $request->short_description;
        $aboutpage->long_description = $request->long_description;
        

        if($request->hasFile('about_image')){
            $newimage = "about_image.".$request->file('about_image')->getClientOriginalName();
            $request->file('about_image')->storeAs('public',$newimage);
            $aboutpage->about_image = $newimage;
            $aboutpage->save();
        $noti = [
            "error"=>false,
            "message"=>"About Page Updated with Image Successfully"
        ];
        return redirect()->back()->with($noti);
        }else{
            $aboutpage->save();
            $noti = [
                "error"=>false,
                "message"=>"About Page Updated without Image Successfull"
            ];
            return redirect()->back()->with($noti);

        }   

     }

     //for forntend page 
     public function homeAbout(){

        $aboutpage = About::find(1);
        return view('frontend.about_page',compact('aboutpage'));

     }
}
