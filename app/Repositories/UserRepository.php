<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{


    public function index($search = null)
    {
        $users = User::when($search, function ($query, $search) {
            $query->where('first_name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('company_name', 'like', "%$search%");
        })
            ->paginate(5)
            ->through(function ($user) {
                $user->roles = $user->getRoleNames();
                return $user;
            });

        return $users;
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully.'], 200);
        } else {
            return response()->json(['error' => 'User not found.'], 404);
        }

    }

    public function createUser($data)
    {
        $user = User::create($data);
        return $user;
    }

    public function inviteUser(array $data)
    {

        return User::create($data);
    }

    public function updateUser($id, $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

}
