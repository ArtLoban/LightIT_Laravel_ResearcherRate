<?php

namespace App\Http\Requests\Admin\Organization\Facility\Department;

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
            'updatedDepartmentId' => 'required|integer',
            'name' => sprintf('required|string|unique:departments,name,%s|max:255', $this->updatedDepartmentId),
            'faculty_id' => 'required|integer'
        ];

        return $rules;
    }
}
