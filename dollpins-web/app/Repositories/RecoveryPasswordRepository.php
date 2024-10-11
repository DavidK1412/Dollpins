<?php

namespace App\Repositories;

use App\Models\recoverypassword;

class RecoveryPasswordRepository
{
    public function createToken($user_id, $token)
    {
        return recoverypassword::create([
            'id' => \Illuminate\Support\Str::uuid(),
            'user_id' => $user_id,
            'token' => $token
        ]);
    }

    public function getByToken($token)
    {
        return recoverypassword::where('token', $token)->first();
    }

    public function deleteByUserId($userId)
    {
        return recoverypassword::where('user_id', $userId)->delete();
    }

}
