<?php

namespace App\Http\Requests\Admin\Organization\Employees\AcademicDegree;

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
            'updatedAcademicDegreeId' => 'required|integer',
            'name' => sprintf('required|string|unique:academic_degrees,name,%s|max:255', $this->updatedAcademicDegreeId),
        ];

        return $rules;
    }
}
