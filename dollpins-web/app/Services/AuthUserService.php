<?php

namespace App\Services;

use App\Repositories\AuthUserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthUserService
{
    protected $authUserRepository;

    public function __construct(AuthUserRepository $authUserRepository)
    {
        $this->authUserRepository = $authUserRepository;
    }

    public function create(array $data)
    {
        $data['id'] = Str::uuid();
        $data['password'] = Hash::make($data['password']); // Encriptar la contraseña
        $user = $this->authUserRepository->create($data);

        if ($user) {
            if (isset($data['roles'])) {
                foreach ($data['roles'] as $role) {
                    $this->authUserRepository->assignRole($user->id, $role);
                }
                return $user;
            }
            $this->authUserRepository->assignRole($user->id, $data['role_id']);
        }
        return $user;
    }

    public function getByEmail($email)
    {
        return $this->authUserRepository->findByEmail($email);
    }

    public function login(array $credentials)
    {
        return Auth::attempt($credentials);
    }

    public function logout()
    {
        Auth::logout();
    }

    public function changePassword($user, $password)
    {
        $this->authUserRepository->updatePassword($user->id, Hash::make($password));
        $this->authUserRepository->activateUser($user->id);
    }

    public function delete($id)
    {
        return $this->authUserRepository->delete($id);
    }
}
