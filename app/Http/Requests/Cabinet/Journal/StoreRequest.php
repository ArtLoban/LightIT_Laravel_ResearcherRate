<?php

namespace App\Http\Requests\Cabinet\Journal;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|unique:journals|string|max:255',
            'issn' => 'required|string',
            'country' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'journal_type_id' => 'required|integer',
        ];
    }
}
