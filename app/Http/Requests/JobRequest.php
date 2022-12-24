<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'open' => 'required|boolean',
            'company' => 'required|string|max:255',
            'avatar' => 'required|mimes:jpeg,png,jpg|max:10000',
            'location' => 'required|string|max:255',
            'jobTitle' => 'required|string|max:255',
            'jobType' => 'required|string|max:255',
            'employmentType' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'categories' => 'string',
        ];
    }
}
