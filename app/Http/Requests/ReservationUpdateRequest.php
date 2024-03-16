<?php

namespace App\Http\Requests;

use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Illuminate\Foundation\Http\FormRequest;

class ReservationUpdateRequest extends FormRequest
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
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'tel_number' => 'required',
            'res_date' => ['required', 'date', new DateBetween, new TimeBetween],
            'table_id' => 'required',
            'guest_number' => 'required'
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
            'first_name.required' => 'First Name  is required!',
            'first_name.min' => 'First Name  must be more than 3 character',
            'first_name.max' => 'First Name  must be less than 50 character',

            'last_name.required' => 'Last Name  is required!',
            'last_name.min' => 'Last Name  must be more than 3 character',
            'last_name.max' => 'Last Name  must be less than 50 character',

            'email.email' => 'This is not an email',
            'email.required' => 'Email  is required!',

            'tel_number.required' => 'Tel Number  is required!',

            'res_date.required' => 'Reservation Date  is required!',

            'table.required' => 'Table  is required!',

            'guest_number.required' => 'Guest Number is Required',
        ];
    }
}
