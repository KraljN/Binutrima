<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'ime'=>'regex:/^([A-ZĐŠĆŽČ][a-zšđćžč]{1,14})+(\s[A-ZĐŠĆŽČ][a-zšđćžč]{2,14})*$/',
            'prezime'=>'regex:/^([A-ZĐŠĆŽČ][a-zšđćžč]{1,14})+(\s[A-ZĐŠĆŽČ][a-zšđćžč]{2,14})*$/',
            'email'=>'required|email|min:10',
            'pass'=>'regex:/[\dA-z\.\-\_]{4,15}/',
            'username'=>'regex:/[\dA-z\.\-\_]{4,15}/'
        ];
    }
    public function messages()
    {
        return [
            'ime.regex' => 'Unesite ime u željenom formatu: Petar (2-15 karaktera)',
            'prezime.regex' => 'Unesite prezime u željenom formatu: Mišković Perić',
            'email.email'=>'Unesite email u željenom formatu (petar@gmail.com)',
            'pass.regex'=>'Dozvoljeni brojevi, slova i .-_ (4-15 karaktera)',
            'username.regex'=>'Dozvoljeni brojevi, slova i .-_ (4-15 karaktera)'
        ];
    }
}
