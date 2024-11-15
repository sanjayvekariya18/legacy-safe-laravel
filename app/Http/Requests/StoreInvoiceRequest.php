<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id', // Ensures user_id exists in users table and is required
            'name' => 'required|string|max:255', // Name field validation
            'amount' => 'required|numeric|min:0', // Ensures amount is numeric and non-negative
            'description' => 'nullable|string|max:1000', // Optional description with a max length
        ];
    }
}
