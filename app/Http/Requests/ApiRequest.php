<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
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
            'heights' => 'required|array|min:3',
            'heights.*' => 'integer'
        ];
    }
    public function messages(): array
    {
        return [
            'heights.required' => 'Error 1001: Heights field is required.',
            'heights.array' => 'Error 1002: Heights field is not an array.',
            'heights.min' => 'Error 1003: Heights field must have at least three elements.',
            'heights.*.integer' => 'Error 1004: Each element in the Heights field must be an integer.'
        ];
    }
}
