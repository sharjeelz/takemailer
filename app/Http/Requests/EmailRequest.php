<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
            'to'            => 'required|string|email|max:255',
            'subject'       => 'required|string|max:150',
            'message'       => 'required|string|max:255'
        ];

        
    }

    public function messages()
    {

        return [
            'to.required' => 'Email Recepient is a required field',
            'subject.required' => 'Email Recepient is a required field',
            'message.required' => 'Email Recepient is a required field',

        ];
    }
}
