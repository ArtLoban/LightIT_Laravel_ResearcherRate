<?php

namespace App\Http\Requests\Cabinet\Editions\ThesisDigest;

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
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:255',
            'language' => 'nullable|string',
            'year' => 'nullable|integer|digits:4',
            'pages' => 'nullable|string',
        ];
    }
}
