<?php

namespace App\Http\Requests\Cabinet\Publications\Patents;

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
            'ipc' => 'required|string|max:255',
            'patent_number' => 'required|string|max:255',
            'application_number' => 'required|string|max:255',
            'filing_date' => 'required|date_format:Y-m-d',
            'priority_date' => 'required|date_format:Y-m-d',
            'authors' => 'required|string',
            'patent_bulletin_id' => 'required|integer',
            'file' => 'nullable|mimes:pdf,doc,docx',
        ];
    }
}
