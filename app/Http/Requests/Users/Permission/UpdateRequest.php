<?php

namespace App\Http\Requests\Users\Permission;

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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'updatedPermissionId' => 'required|integer',
            'name' => sprintf('required|string|unique:permissions,name,%s|max:255', $this->updatedPermissionId),
        ];

        return $rules;
    }
}
