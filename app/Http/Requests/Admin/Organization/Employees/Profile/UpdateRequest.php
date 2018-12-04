<?php

namespace App\Http\Requests\Admin\Organization\Employees\Profile;

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
            'updatedProfileId' => 'required|integer',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'patronymic' => 'nullable|string|max:255',
            'birth_date' => 'required|date_format:Y-m-d',
            'position_id' => 'required|integer',
            'ac_degree_id' => 'required|integer',
            'ac_title_id' => 'required|integer',
            'department_id' => 'required|integer',
        ];

        return $rules;
    }
}
