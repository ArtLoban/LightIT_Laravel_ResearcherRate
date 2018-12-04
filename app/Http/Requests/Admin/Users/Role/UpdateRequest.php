<?php

namespace App\Http\Requests\Admin\Users\Role;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'updatedRoleId' => 'required|integer',
            'name' => sprintf('required|string|unique:roles,name,%s|max:255', $this->updatedRoleId),
        ];

        return $rules;
    }
}
