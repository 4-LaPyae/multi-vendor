<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FooterRequest extends FormRequest
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
            "number"=>"required",
            "short_description"=>"required",
            "address"=>"required",
            "email"=>"required",
            "facebook"=>"required",
            "twitter"=>"required",
            "copyright"=>"required"
        ];
    }

    public function messages()
    {
        return[
            "number.required"=>"Number is required",
            "short_description.required"=>"short description is required",
            "address.required"=>"Address is required",
            "email.required"=>"Email is required",
            "facebook.required"=>"Facebook is required",
            "twitter.required"=>"Twitter is required",
            "copyright.required"=>"Copyright is required"
        ];
    }
}
