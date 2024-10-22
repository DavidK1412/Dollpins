<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository
{

        protected Role $role;

        public function __construct(Role $role)
        {
            $this->role = $role;
        }

        public function getRoles()
        {
            return $this->role->all();
        }

}
