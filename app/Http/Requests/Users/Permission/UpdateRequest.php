<?php

namespace App\Http\Requests\Users\Permission;

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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|unique:permissions|max:255'
        ];

        if ($this->updatedPermissionId) {
            $rules['name'] = sprintf('required|string|unique:permissions,name,%s|max:255', $this->updatedPermissionId);
        }

        return $rules;
    }
}
