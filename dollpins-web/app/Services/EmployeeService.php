<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;
use Illuminate\Support\Str;

class EmployeeService
{

        protected EmployeeRepository $employeeRepository;

        public function __construct(EmployeeRepository $employeeRepository)
        {
            $this->employeeRepository = $employeeRepository;
        }

        public function getAllEmployees()
        {
            return $this->employeeRepository->all();
        }

        public function createEmployee(array $data)
        {
            $data['id'] = Str::uuid();
            foreach ($data['positions'] as $position) {
                $data['positions'] = $position;
            }

            return $this->employeeRepository->create($data);
        }

        public function getEmployeeById($id)
        {
            return $this->employeeRepository->findById($id);
        }

        public function updateEmployee($id, array $data)
        {
             $employee = $this->employeeRepository->findById($id);
             if ($employee->positions != null) {
                 foreach ($employee->positions as $position) {
                     $this->employeeRepository->removeEmployeePosition($id, $position);
                 }
             }

             $this->employeeRepository->removeRole($employee->user_id);



             foreach ($data['roles'] as $role) {
                 $this->employeeRepository->assignRole($employee->user_id, $role);
             }
             foreach ($data['positions'] as $position) {
                $this->employeeRepository->assignEmployeePosition($id, $position);
             }

            unset($data['city']);
            unset($data['roles']);
            unset($data['positions']);
            return $this->employeeRepository->update($id, $data);
        }

        public function deleteEmployee($id)
        {
            return $this->employeeRepository->delete($id);
        }

        public function getEmployeeRoles($employee_id)
        {
            return $this->employeeRepository->getEmployeeRoles($employee_id);
        }

        public function getEmployeePositions($employee_id)
        {
            return $this->employeeRepository->getEmployeePositions($employee_id);
        }

        public function assignRole($employee_id, $role_id)
        {
            return $this->employeeRepository->assignRole($employee_id, $role_id);
        }

        public function removeRole($employee_id, $role_id)
        {
            return $this->employeeRepository->removeRole($employee_id, $role_id);
        }
}
