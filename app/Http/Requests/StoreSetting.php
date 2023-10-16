<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSetting extends FormRequest
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
            'title'          => 'required',
            'logo'          => 'nullable|mimes:png',
            'email'          => 'nullable',
            'address'          => 'nullable',
            'phone'          => 'required',
            'terms'        => 'required',
            'privacy'        => 'required',
            'facebook'          => 'required|url',
            'youtube'          => 'required|url',
            'linkedin'          => 'required|url',
            'instagram'          => 'required|url',
            'twitter'          => 'required|url',
            'whatsapp'          => 'required|url',
        ];
    }
}
