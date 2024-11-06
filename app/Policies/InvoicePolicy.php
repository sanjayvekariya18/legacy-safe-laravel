<?php

namespace App\Policies;

use App\Models\User;

class InvoicePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user)
    {
        // Allow Admin and Professional to view invoices
        return $user->hasRole([User::ROLE_ADMIN, User::ROLE_PROFESSIONAL]);
    }

    public function create(User $user)
    {
        // Only Admin can create invoices
        return $user->hasRole(User::ROLE_ADMIN);
    }

    public function view(User $user)
    {
        // Allow Admin and Professional to view individual invoices
        return $user->hasRole([User::ROLE_ADMIN, User::ROLE_PROFESSIONAL]);
    }

    public function update(User $user)
    {
        // Only Admin can update invoices
        return $user->hasRole(User::ROLE_ADMIN);
    }

    public function delete(User $user)
    {
        // Only Admin can delete invoices
        return $user->hasRole(User::ROLE_ADMIN);
    }

    public function pay(User $user)
    {
        // Only Professional can pay invoices
        return $user->hasRole(User::ROLE_PROFESSIONAL);
    }
}
