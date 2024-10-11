<?php

namespace App\Repositories;

use App\Models\employee;

class EmployeeRepository
{

    protected employee $employee;

    public function __construct(employee $employee)
    {
        $this->employee = $employee;
    }


    public function all()
    {
        return $this->employee->all();
    }

    public function create(array $data)
    {
        return $this->employee->create($data);
    }

    public function findById($id)
    {
        return $this->employee->find($id);
    }

    public function update($id, array $data)
    {
        return $this->employee->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->employee->where('id', $id)->update(['status' => 2]);
    }

    public function getEmployeeRoles($employee_id)
    {
        return $this->employee->find($employee_id)->roles;
    }

    public function assignRole($employee_id, $role_id)
    {
        return $this->employee->find($employee_id)->roles()->attach($role_id);
    }

    public function removeRole($employee_id, $role_id)
    {
        return $this->employee->find($employee_id)->roles()->detach($role_id);
    }


}
