<?php

namespace App\Repositories;

use App\Models\role;

class RoleRepository
{

        protected role $role;

        public function __construct(role $role)
        {
            $this->role = $role;
        }

        public function getRoles()
        {
            return $this->role->all();
        }

}
