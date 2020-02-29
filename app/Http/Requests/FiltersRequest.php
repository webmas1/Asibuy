<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FiltersRequest extends FormRequest
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
            'role' => 'nullable|alpha|min:2|max:10',
            'created_at' => 'nullable|alpha|min:2|max:10',
            'updated_at' => 'nullable|alpha|min:2|max:10'
        ];
    }
}
