<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'previous_page' => 'url',
            'first_name' => 'required|alpha|min:2|max:20',
            'last_name' => 'required|alpha|min:2|max:20',
            'id_number' => 'required|digits:9|integer',
            'phone' => [
                "required",
                "regex:/^\(?([0-9]{3})\)?[- ]?([0-9]{7})$|^\(?([0-9]{2})\)?[- ]?([0-9]{7})$/"
                ]
        ];
    }
}
