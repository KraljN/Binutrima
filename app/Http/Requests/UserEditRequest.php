<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'profilePictureFile'=>'sometimes|file|mimes:jpg,jpeg,png,gif|max:2048',
            'imeEdit'=>'regex:/^([A-ZĐŠĆŽČ][a-zšđćžč]{1,14})+(\s[A-ZĐŠĆŽČ][a-zšđćžč]{2,14})*$/',
            'prezimeEdit'=>'regex:/^([A-ZĐŠĆŽČ][a-zšđćžč]{1,14})+(\s[A-ZĐŠĆŽČ][a-zšđćžč]{2,14})*$/',
            'emailEdit'=>'required|email|min:10',
            'passOld'=>'nullable|regex:/[\dA-z\.\-\_]{4,15}/',
            'passNew'=>'nullable|regex:/[\dA-z\.\-\_]{4,15}/',
            'usernameEdit'=>'regex:/[\dA-z\.\-\_]{4,15}/'
        ];
    }
    public function messages()
    {
        return [
            'imeEdit.regex' => 'Unesite ime u željenom formatu: Petar (2-15 karaktera)',
            'prezimeEdit.regex' => 'Unesite prezime u željenom formatu: Mišković Perić',
            'emailEdit.email'=>'Unesite email u željenom formatu (petar@gmail.com)',
            'passOld.regex'=>'Dozvoljeni brojevi, slova i .-_ (4-15 karaktera)',
            'passNew.regex'=>'Dozvoljeni brojevi, slova i .-_ (4-15 karaktera)',
            'usernameEdit.regex'=>'Dozvoljeni brojevi, slova i .-_ (4-15 karaktera)',
            'profilePictureFile.mimes'=>'Izaberite .jpg, .jpeg, .png, .gif',
            'profilePictureFile.max'=>'Izaberite sliku manju od 2 MB',
        ];
    }
}
