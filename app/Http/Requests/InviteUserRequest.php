<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class InviteUserRequest extends FormRequest
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
        $selectedRole = $this->input('role');
        $rules = [
            'email' => ['required', 'email', function ($attribute, $value, $fail) use($selectedRole) {
                // Prevent inviting oneself
                if ($value === $this->user()->email) {
                    $fail('You cannot invite yourself.');
                }
                $invitedUser = User::where('email', $value)->first();
                if ($invitedUser && !$invitedUser->hasRole($selectedRole)) {
                    $fail("The selected email does not match the role.");
                }
            }]
        ];
        if ($selectedRole == User::ROLE_CLIENT ) {
            $rules['professional_type'] = 'nullable';
        } elseif ($selectedRole == User::ROLE_PROFESSIONAL) {
            $rules['professional_type'] = 'required|string|in:' . implode(',', User::PROFESSIONAL_TYPES);
        }
        return $rules;
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'professional_type.string' => 'Professional type must be a valid string.',
        ];
    }

    /**
     * Override the failedValidation method to handle custom error bags.
     *
     * @param Validator $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        // Here we can pass a specific error bag
        // Assign a unique error bag based on the form type or other parameters
        $role = $this->input('role', 'default');
        throw new HttpResponseException(
            redirect()->route('shared.users.index') // Adjust the route name as needed
                ->withErrors($errors, $role)
                ->withInput()
        );
    }
}
