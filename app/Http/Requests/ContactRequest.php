<?php

namespace App\Http\Requests;

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
     * @return array
     */
    public function rules()
    {
        return [
            'nameContact'=>'regex:/^[A-zČĆŽĐŠćčžđš]{2,20}(\s[A-zČĆŽĐŠćčžđš]{2,20})*$/',
            'subject'=>'regex:/^[A-zČĆŽĐŠćčžđš][A-zČĆŽĐŠćčžđš\d]{2,20}(\s[A-zČĆŽĐŠćčžđš\d]{1,20})*$/',
            'emailContact'=>'required|email|',
            'message'=>'required|min:2|max:250'
        ];
    }
    public function messages()
    {
            return [
                'nameContact.regex'=>'Dozvoljena samo slova (maksimalna dužina 20)',
                'subject.regex'=>'Naslov mora počinjati slovom i nisu dozvoljeni specijalni karakteri (maksimalna dužina 70 karaktera )',
                'emailContact.required'=>'Email ne sme biti prazan',
                'emailContact.email'=>'Email mora biti u dozvoljenom formatu (pera@gmail.com)',
                'message.required'=>'Poruka ne sme biti prazna',
                'message.min'=>'Poruka mora imati minimalno 2 karaktera',
                'message.max'=>'Poruka ne sme  biti duža od 250 karaktera'
            ];
    }
}
//"nameContact" => null
//  "subject" => null
//  "emailContact" => null
//  "message" => null
