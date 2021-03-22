<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        return [
            'passLog'=>'regex:/[\dA-z\.\-\_]{4,15}/',
            'usernameLog'=>'regex:/[\dA-z\.\-\_]{4,15}/'
        ];
    }
    public function messages()
    {
        return [
            'passLog.regex'=>'Dozvoljeni brojevi, slova i .-_ (4-15 karaktera)',
            'usernameLog.regex'=>'Dozvoljeni brojevi, slova i .-_ (4-15 karaktera)'
        ];
    }
}
