<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticatedSession extends FormRequest
{
    protected $redirect = "/login";

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
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string','min:8'],
        ];
    }

    public function messages()
    {
        return[
            'email.required' => 'Email is required',
            'email.email' => 'Email must be emial',
            'password.required' => 'Password is required',
            'password.min'=>'password at least 8 character'        
        ];
    }
}
