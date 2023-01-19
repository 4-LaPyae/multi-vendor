<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class RegisteredUser extends FormRequest
{
    protected $redirect = "/register";

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
            'name' => 'required|string|min:5',
            'email' => 'required|string|unique:users',
            'username'=>"nullable",
            'password' => 'required|min:8',
            'password_confirmation'=>'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be string',
            'name.min' => 'Name must be at least 5 characters.',
            'email.required'=> 'Email is required',
            'email.string'=>'Email must be string',
            'password.required'=>'Password is required',
            'password.min'=>'The password must be at least 8 characters.',
            'password_confirmation.required'=>'Confirm password is required',
            'password_confirmation.same'=>'Your password must be same'
        ];
    }

    // public function failedValidation(Validator $validator)
    // {

        // return view('auth.register');
        // dd($validator->errors());
        // throw new HttpResponseException(response()->json([
        //     'error'   => true,
        //     'message'   => 'Validation errors',
        //     'data'      => $validator->errors()
        // ]));
    // }
}
