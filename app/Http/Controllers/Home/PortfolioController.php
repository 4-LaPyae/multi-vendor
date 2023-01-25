<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\StorePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Http\Controllers\Controller;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolio = Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all',compact('portfolio'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.portfolio.portfolio_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePortfolioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePortfolioRequest $request)
    {
        $validator =  $request->validated();
                if($request->hasFile('portfolio_image')){
                 $newimage = "portfolio_images/portfolio_image".hexdec(uniqid()).'.'.$request->file('portfolio_image')->getClientOriginalExtension();
                    //hexdec(uniqid()).'.'.$newimage;
                    $request->file('portfolio_image')->storeAs('public',$newimage);
                    $validator['portfolio_image'] = $newimage;
                }
                Portfolio::create($validator);
                $noti = [
                    "error"=>false,
                    "message"=>"Portfolio created Successfully"
                ];
                
        return redirect()->back()->with($noti);
        
      
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        return view('frontend.portfolio_detail',compact('portfolio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
       return view('admin.portfolio.portfolio_edit',compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePortfolioRequest  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio)
    {
       $validator = $request->validated();
       if($request->hasFile('portfolio_image')){
                $newimage = "portfolio_images/portfolio_image".hexdec(uniqid()).'.'.$request->file('portfolio_image')->getClientOriginalExtension();
                $request->file('portfolio_image')->storeAs('public',$newimage);
                $validator['portfolio_image'] = $newimage;
                $portfolio->update($validator);
                $noti = [
                    "error"=>false,
                    "message"=>"Portfolio update with image Successfully"
                ];              
        return redirect()->route('portfolios.index')->with($noti);
       }
       $portfolio->update($validator);
       $noti = [
        "error"=>false,
        "message"=>"Portfolio update without image Successfully"
    ];              
return redirect()->route('portfolios.index')->with($noti);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
      $portfolio->delete();
      $noti = [
        "error"=>false,
        "message"=>"Portfolio id deleted!"
        ];              
    return redirect()->route('portfolios.index')->with($noti);
    }


    public function homePortfolio(){
        $portfolio = Portfolio::latest()->get();
        return view('frontend.portfolio',compact('portfolio'));
    }
}
