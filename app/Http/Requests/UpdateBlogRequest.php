<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "blog_category_id"=>"nullable",
            "blog_title"=>"required",
            "blog_tags"=>"nullable",
            "blog_description"=>"required",
            "blog_image"=>"nullable"
        ];
    }

    public function messages()
    {
        return [
            "blog_title.required"=>"Blog title is required",
            "blog_description.required"=>"Blog description is required"
        ];

    } 
}
