<?php

namespace App\Http\Requests\Cabinet\Editions\PatentBulletin;

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
            'week' => 'required|integer|digits_between:1,2',
            'year' => 'required|string|digits:4',
            'date' => 'required|date|date_format:Y-m-d',
        ];
    }
}