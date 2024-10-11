<?php

namespace App\Repositories;

use App\Models\authuser;
use App\Models\userrole;
use Illuminate\Support\Facades\DB;

class AuthUserRepository
{
    public function findByEmail($email)
    {
        return authuser::where('email', $email)->first();
    }

    public function create(array $data)
    {
        return authuser::create($data);
    }

    public function assignRole($user_id, $role_id)
    {
        return userrole::create([
            'id' => \Illuminate\Support\Str::uuid(),
            'user_id' => $user_id,
            'role_id' => $role_id
        ]);
    }

    public function getUserRoles($user_id)
    {
        return DB::table('authuser')
            ->join('userrole', 'authuser.id', '=', 'userrole.user_id')
            ->join('role', 'userrole.role_id', '=', 'role.id')
            ->where('authuser.id', $user_id)
            ->select('role.name')
            ->get();
    }

    public function updatePassword($user_id, $password)
    {
        return authuser::where('id', $user_id)->update(['password' => $password]);
    }

    public function activateUser($user_id)
    {
        return authuser::where('id', $user_id)->update(['active' => true]);
    }

    public function delete($id)
    {
        return authuser::where('id', $id)->update(['active' => false]);
    }

}
