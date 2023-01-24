<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            "name"=>"required",
            "email"=>"required",
            "subject"=>"required",
            "phone"=>"required",
            "message"=>"required"
        ];
    }

    public function messages()
    {
        return[
            "name.required"=>"Name is required",
            "email.required"=>"Email is required",
            "subject.required"=>"Subject is required",
            "phone.required"=>"Phone is required",
            "message.required"=>"Message is required"
        ];
    }

}
