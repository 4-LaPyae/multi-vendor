<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blog.blog_all',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BlogCategory::orderBy('blog_category','asc')->get();
        return view('admin.blog.blog_add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $validator =  $request->validated();
        $checkimage = $validator['blog_image'] ?? null;
        if($checkimage){
            $newimage = "blog_images/blog_image.".$checkimage->getClientOriginalName();
            $checkimage->storeAs('public',$newimage); 
            $validator['blog_image'] = $newimage;        
    }
    Blog::create($validator);
        $noti = [
            "error"=>false,
            "message"=>"Blog created Successfully"
        ];    
return redirect()->route('blogs.index')->with($noti);

}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $allblogs = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy('blog_category','asc')->get();
        return view('frontend.blog_details',compact('blog','allblogs','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $categories = BlogCategory::orderBy('blog_category','asc')->get();
        return view('admin.blog.blog_edit',compact('blog','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $validator =  $request->validated();
        $checkimage = $validator['blog_image'] ?? null;
        if($checkimage){
            $newimage = "blog_images/blog_image.".$checkimage->getClientOriginalName();
            $checkimage->storeAs('public',$newimage); 
            $validator['blog_image'] = $newimage; 
            $blog->update($validator);
            $noti = [
            "error"=>false,
            "message"=>"Blog is updated with image Successfully"
        ];    
return redirect()->route('blogs.index')->with($noti);

    }
   $blog->update($validator);
        $noti = [
            "error"=>false,
            "message"=>"Blog is updated with image Successfully"
        ];    
return redirect()->route('blogs.index')->with($noti);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        unlink('storage/'.$blog->blog_image);
        $blog->delete();
        return redirect()->back()->with(["message"=>"Blog is deleted!"]);
    }

    public function CategoryBlog($id){

        $blogpost = Blog::where('blog_category_id',$id)->orderBy('id','DESC')->get();
        $allblogs = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        $categoryname = BlogCategory::findOrFail($id);
        return view('frontend.cat_blog_details',compact('blogpost','allblogs','categories','categoryname'));
     }

     public function HomeBlog(){
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        $allblogs = Blog::latest()->get();
        return view('frontend.blog',compact('allblogs','categories'));

     }
}
