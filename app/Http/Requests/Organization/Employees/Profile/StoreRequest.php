<?php

namespace App\Http\Requests\Organization\Employees\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'patronymic' => 'nullable|string|max:255',
            'birth_date' => 'required|date_format:Y-m-d',
            'position_id' => 'required|integer',
            'ac_degree_id' => 'required|integer',
            'ac_title_id' => 'required|integer',
            'department_id' => 'required|integer',
        ];
    }
}
