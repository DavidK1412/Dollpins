<?php

namespace App\Repositories;

use App\Models\AuthUser;
use App\Models\UserRole;
use Illuminate\Support\Facades\DB;

class AuthUserRepository
{
    public function findByEmail($email)
    {
        return AuthUser::where('email', $email)->first();
    }

    public function create(array $data)
    {
        return AuthUser::create($data);
    }

    public function assignRole($user_id, $role_id)
    {
        return UserRole::create([
            'id' => \Illuminate\Support\Str::uuid(),
            'user_id' => $user_id,
            'role_id' => $role_id
        ]);
    }

    public function getUserRoles($user_id)
    {
        return DB::table('AuthUser')
            ->join('UserRole', 'AuthUser.id', '=', 'UserRole.user_id')
            ->join('Role', 'UserRole.role_id', '=', 'Role.id')
            ->where('AuthUser.id', $user_id)
            ->select('Role.name')
            ->get();
    }

    public function updatePassword($user_id, $password)
    {
        return AuthUser::where('id', $user_id)->update(['password' => $password]);
    }

    public function activateUser($user_id)
    {
        return AuthUser::where('id', $user_id)->update(['active' => true]);
    }

    public function delete($id)
    {
        return AuthUser::where('id', $id)->update(['active' => false]);
    }

}
