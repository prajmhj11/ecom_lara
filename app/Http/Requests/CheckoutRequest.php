<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        // $emailValidation = Auth::user() ? 'required|email' : 'required|email|unique:users,email';
        return [
            'email' => 'required|email',
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postalcode' => 'required',
            'phone' => 'required',
        ];
    }

    // public function messages()
    // {
    //     return [
    //          'email.unique' => 'Already have an account. Please <a href='#'>Login</a> to continue';
    //         'city.required' => "It's required.",
    //     ];
    // }
}
