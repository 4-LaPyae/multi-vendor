<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogCategoryRequest;
use App\Http\Requests\UpdateBlogCategoryRequest;
use App\Models\BlogCategory;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogcategory = BlogCategory::latest()->get();
        return view('admin.blog_category.blog_category_all',compact('blogcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog_category.blog_category_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogCategoryRequest $request)
    {
        $validator =  $request->validated();
        BlogCategory::create($validator);
        $noti = [
            "error"=>false,
            "message"=>"Blog Category Inserted Successfully",
            "alert-type" => "success"
        ];
        return redirect()->route('blogcategories.index')->with($noti);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $blogcategory)
    {
        return view('admin.blog_category.blog_category_edit',compact('blogcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogCategoryRequest  $request
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogCategoryRequest $request, BlogCategory $blogcategory)
    {
        $validator = $request->validated();
        $blogcategory->update($validator);
        $noti = [
            'error'=>false,
            'message' => 'Blog Category Updated Successfully', 
            'alert-type' => 'success'
        ];
        return redirect()->route('blogcategories.index')->with($noti);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategory $blogcategory)
    {
         $blogcategory->delete();
         $noti = [
            "error"=>false,
            "message"=>"Blog Category Deleted Successfully",
            "alert-type"=>'success'
         ];
         return redirect()->back()->with($noti);       
        }
}
