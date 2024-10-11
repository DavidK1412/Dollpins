<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService
{
    protected RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAll()
    {
        $roles = $this->roleRepository->getRoles();
        $roles->transform(function ($role) {
            $role->name = ucfirst(strtolower($role->name));
            return $role;
        });
        return $roles;
    }

}
