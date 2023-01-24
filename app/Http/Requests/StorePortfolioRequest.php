<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Redirect;

class StorePortfolioRequest extends FormRequest
{
    //protected $redirectRoute = 'portfolios.store';
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
            "portfolio_name"=>"required|min:5",
            "portfolio_title"=>"required",
            "portfolio_description"=>"required",
            'portfolio_image' =>'file|mimes:jpg,jpeg,png,gif|max:1024',
        ];
    }

    public function messages()
    {
        return [
            "portfolio_name.required"=>"Portfolio name is required",
            "portfolio_name.min"=>"Portfolio name at least 5 characters",
            "portfolio_title.required"=>"Portfolio title is required",
            "portfolio_description.required"=>"Portfoloo description is required",
            "portfolio_image.file"=>"Portfolio image is file",
            "portfolio_image.mimes"=>"Portfolio mime is jpg,jpeg,png,gif,webp",
            "portfolio_image.max"=>"Portfolio image maximum is 1024px"
        ];
    }
    public function failedValidation(Validator $validator)
    {
        
            return Redirect::back()->withErrors($validator);
        }    
}
