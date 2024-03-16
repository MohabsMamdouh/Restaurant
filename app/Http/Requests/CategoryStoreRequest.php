<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            'name' => 'required|min:3|max:50|unique:categories,name',
            'image' => 'required|image',
            'description' => 'required'
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
            'name.unique' => 'Category is exist!',
            'name.min' => 'Name  must be more than 3 character',
            'name.max' => 'Name  must be less than 50 character',

            'image.image' => 'This is not an image',
            'image.required' => 'Image  is required!',
            'description.required' => 'Description  is required!',
        ];
    }
}
