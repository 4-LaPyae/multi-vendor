<?php

namespace App\Models;

use App\Traits\FillableTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory,FillableTraits;
    protected $with = ['category'];
    public function category(){
        return $this->belongsTo(BlogCategory::class,'blog_category_id','id');
    }
}
