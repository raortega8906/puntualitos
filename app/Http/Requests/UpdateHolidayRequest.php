<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHolidayRequest extends FormRequest
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
            'beginning' => ['required', 'date'],
            'finished' => ['required', 'date', 'after_or_equal:beginning'],
        ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'beginning.after_or_equal' => 'La fecha de inicio debe ser hoy o posterior.',
            'finished.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',
        ];
    }
}
