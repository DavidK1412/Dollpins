<?php

namespace App\Repositories;

use App\Models\employee;
use Illuminate\Support\Facades\DB;

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

    public function getEmployeePositions($employee_id)
    {
        return $this->employee->find($employee_id)->positions;
    }

    public function assignEmployeePosition($employee_id, $position)
    {

        return DB::table('employeeposition')->insert([
            'id' => \Illuminate\Support\Str::uuid(),
            'employee_id' => $employee_id,
            'position_id' => $position
        ]);
    }

    public function removeEmployeePosition($employee_id, $position)
    {
        return DB::table('employeeposition')->where('employee_id', $employee_id)->where('position_id', $position->position_id)->delete();
    }

    public function assignRole($employee_id, $role_id)
    {
        return DB::table('userrole')->insert([
            'id' => \Illuminate\Support\Str::uuid(),
            'user_id' => $employee_id,
            'role_id' => $role_id
        ]);
    }

    public function removeRole($employee_id, $role_id=1)
    {
        return DB::table('userrole')
            ->where('user_id', $employee_id)
            ->delete();
    }


}
