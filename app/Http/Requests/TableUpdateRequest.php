<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:50',
            'guest_number' => 'required',
            'status' => 'required',
            'location' => 'required'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name  is required!',
            'name.min' => 'Name  must be more than 3 character',
            'name.max' => 'Name  must be less than 50 character',

            'guest_number.required' => 'Guest Number  is required!',
            'status.required' => 'Status  is required!',
            'location.required' => 'Location  is required!',
        ];
    }
}
