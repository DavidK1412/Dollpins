<?php

namespace App\Repositories;

use App\Models\RecoveryPassword;

class RecoveryPasswordRepository
{
    public function createToken($user_id, $token)
    {
        return RecoveryPassword::create([
            'id' => \Illuminate\Support\Str::uuid(),
            'user_id' => $user_id,
            'token' => $token
        ]);
    }

    public function getByToken($token)
    {
        return RecoveryPassword::where('token', $token)->first();
    }

    public function deleteByUserId($userId)
    {
        return RecoveryPassword::where('user_id', $userId)->delete();
    }

}
