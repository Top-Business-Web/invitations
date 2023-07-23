<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvitationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [

            'date' => 'required',
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'sur_name' => 'required|in:mr/mis,honored',
            'address' => 'required',
        ];
    }
}
