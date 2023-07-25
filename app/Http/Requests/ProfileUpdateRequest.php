<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            "name" => "required",
            'email' => 'required|unique:users,email,' . auth()->user()->id,
            "address" => "required",
            "phone" => "required|min:11",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => " الاسم مطلوب",
            'email.required' => 'الايميل مطلوب',
            'email.unique' => 'الايميل موجود',
            "address.required" => "المكان مطلوب",
            "phone.required" => "الهاتف مطلوب",
            "phone.min" => "يجب ان يكون 11 رقم على الاقل",
        ];
    }
}
