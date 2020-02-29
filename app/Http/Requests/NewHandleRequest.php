<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewHandleRequest extends FormRequest
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
            'ticket_id' => 'required|integer|exists:customers,id',
            'headline' => 'required|filled|string|min:3|max:200',
            'handle' => 'required|filled|string|min:10|max:10000'
        ];
    }
}
