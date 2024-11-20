<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UserRoleCheck implements ValidationRule
{
    protected $role;

    /**
     * Create a new rule instance.
     *
     * @param string $role The required role to check against.
     */
    public function __construct($role)
    {
        $this->role = $role;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = User::find($value);

        if (!$user || !$user->hasRole($this->role)) {
            $fail('The selected user does not have the required role.');
        }
    }
}
