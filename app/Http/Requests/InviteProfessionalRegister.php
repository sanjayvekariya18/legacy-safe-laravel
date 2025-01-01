<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InviteProfessionalRegister extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'mobile_number' => 'required|string|min:10|max:15',
            'company_name' => 'nullable|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'postcode' => 'required|string|max:6',
            'role' => 'nullable|string',
        ];
    }
}
