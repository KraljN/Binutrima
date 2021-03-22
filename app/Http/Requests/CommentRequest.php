<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'text'=>'min:1|max:250|required'
        ];
    }
    public function messages()
    {
        return [
            'text.min'=>'Komentar ne sme biti prazan',
            'text.required'=>'Komentar ne sme biti prazan',
            'text.max'=>'Komentar ne sme biti duži od 250 karaktera'
        ];
    }
}
