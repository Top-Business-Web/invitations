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
            'logo'          => 'nullable',
            'terms'        => 'required',
            'privacy'        => 'required',
            'facebook'          => 'required',
            'youtube'          => 'required',
            'linkedin'          => 'required',
            'instagram'          => 'required',
            'twitter'          => 'required',
            'whatsapp'          => 'required',

        ];
    }
}
