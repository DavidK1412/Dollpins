<?php

namespace App\Services;

use App\Repositories\RecoveryPasswordRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class RecoveryPasswordService
{
    protected $repository;

    public function __construct(RecoveryPasswordRepository $repository)
    {
        $this->repository = $repository;
    }

    public function generateToken($user)
    {
        $token = Hash::make(Str::random(20));
        $token = base64_encode($token);
        $this->repository->deleteByUserId($user->id);
        $this->repository->createToken($user->id, $token);

        return $token;
    }

    public function validateToken($token)
    {
        return $this->repository->getByToken($token);
    }

    public function deleteToken($userId)
    {
        return $this->repository->deleteByUserId($userId);
    }
}
