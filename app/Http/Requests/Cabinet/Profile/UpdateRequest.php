<?php

namespace App\Http\Requests\Cabinet\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'current_password' => 'The current password do not match our records',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'updatedUserId' => 'required|integer',
            'email' => sprintf('required|string|email|max:255|unique:users,email,%s', $this->updatedUserId),
            // current_password - is a custom rule. Defined in AppServiceProvider
            'current_password' => 'required|string|min:6|current_password',
            'password' => 'nullable|string|min:6|confirmed',
        ];

        return $rules;
    }
}
