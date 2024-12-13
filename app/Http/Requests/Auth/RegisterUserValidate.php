<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserValidate extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'mobile_number' => 'required|string|min:10|max:15',
            'company_name' => 'nullable|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'required|nullable|string|max:255',
            'country' => 'required|string|max:255',
            'postcode' => 'required|string|max:6',
            'role' => 'string',
        ];
    }
}




















