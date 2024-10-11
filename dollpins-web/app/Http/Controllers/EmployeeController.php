<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\EmployeeService;
use App\Services\AuthUserService;
use App\Services\RecoveryPasswordService;
use App\Services\MailService;
use App\Services\RoleService;
use App\Services\CityService;
use App\Services\PositionService;


class EmployeeController
{
    protected EmployeeService $employeeService;
    protected AuthUserService $authUserService;
    protected RecoveryPasswordService $recoveryPasswordService;
    protected MailService $mailService;
    protected RoleService $roleService;
    protected CityService $cityService;
    protected PositionService $positionService;

    public function __construct(
        EmployeeService $employeeService,
        AuthUserService $authUserService,
        RecoveryPasswordService $recoveryPasswordService,
        MailService $mailService,
        RoleService $roleService,
        CityService $cityService,
        PositionService $positionService
    )
    {
        $this->employeeService = $employeeService;
        $this->authUserService = $authUserService;
        $this->recoveryPasswordService = $recoveryPasswordService;
        $this->mailService = $mailService;
        $this->roleService = $roleService;
        $this->cityService = $cityService;
        $this->positionService = $positionService;
    }

    public function showEmployees()
    {
        $employees = $this->employeeService->getAllEmployees();
        return view('panels.employees.search', compact('employees'));
    }


    public function showEmployee($id)
    {
        $employee = $this->employeeService->getEmployeeById($id);
        return view('employees.show', compact('employee'));
    }

    public function showCreateForm()
    {
        $roles = $this->roleService->getAll();
        $cities = $this->cityService->getAll();
        $positions = $this->positionService->getAllPositions();
        $data = [
            'roles' => $roles,
            'cities' => $cities,
            'positions' => $positions,
        ];
        return view('panels.employees.new', compact('data'));
    }

    public function storeEmployee(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employee',
            'document' => 'required|unique:employee',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'positions' => 'required',
            'roles' => 'required',
        ]);

        $authData = [
            'email' => $data['email'],
            'password' => $data['document'],
            'roles' => $data['roles'],
        ];
        $authUser = $this->authUserService->create($authData);
        $data['user_id'] = $authUser->id;
        $data['city_id'] = $data['city'];
        $employee = $this->employeeService->createEmployee($data);
        $token = $this->recoveryPasswordService->generateToken($authUser);
        $this->mailService->send($authUser->email, '¡Bienvenido a Dollpins!', 'emails.welcome',
            ['name' => $employee->name, 'url' => route('password.reset', $token)]);

        return redirect()->route('employees.search')->with('success', 'Empleado creado exitosamente.');
    }

    public function deleteEmployee($id)
    {
        $employee = $this->employeeService->getEmployeeById($id);
        $this->employeeService->deleteEmployee($id);
        $this->authUserService->delete($employee->user_id);
        return redirect()->route('employees.index')->with('success', 'Empleado eliminado exitosamente.');
    }

}
