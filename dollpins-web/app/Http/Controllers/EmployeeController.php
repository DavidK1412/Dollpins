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


class EmployeeController extends Controller
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
        $roles = $this->roleService->getAll();
        $cities = $this->cityService->getAll();
        $positions = $this->positionService->getAllPositions();
        $employeeRoles = $this->authUserService->getUserRoles($employee->user_id);
        $employeePositions = $this->employeeService->getEmployeePositions($id);
        $data = [
            'employee' => $employee,
            'roles' => $roles,
            'cities' => $cities,
            'positions' => $positions,
            'employeeRoles' => $employeeRoles,
            'employeePositions' => $employeePositions,
        ];
        return view('panels.employees.detail', compact('data'));
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

        return redirect()->route('employees.show')->with('success', 'Empleado creado exitosamente.');
    }

    public function showEditForm($id)
    {
        $employee = $this->employeeService->getEmployeeById($id);
        $roles = $this->roleService->getAll();
        $cities = $this->cityService->getAll();
        $positions = $this->positionService->getAllPositions();
        $employeeRoles = $this->authUserService->getUserRoles($employee->user_id);
        $employeePositions = $this->employeeService->getEmployeePositions($id);
        $data = [
            'employee' => $employee,
            'roles' => $roles,
            'cities' => $cities,
            'positions' => $positions,
            'employeeRoles' => $employeeRoles,
            'employeePositions' => $employeePositions,
        ];

        return view('panels.employees.edit', compact('data'));
    }

    public function editEmployee(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'positions' => 'required',
            'roles' => 'required',
        ]);

        $data['city_id'] = $data['city'];

        $this->employeeService->updateEmployee($id, $data);
        return redirect()->route('employees.show', $id)->with('success', 'Empleado actualizado exitosamente.');
    }

    public function deleteEmployee($id)
    {
        $employee = $this->employeeService->getEmployeeById($id);
        $this->employeeService->deleteEmployee($id);
        $this->authUserService->delete($employee->user_id);
        return redirect()->route('employees.show')->with('success', 'Empleado eliminado exitosamente.');
    }


//metodos para telefono empleado
    public function showEmployeeCellphones($id)
{
    $employee = $this->employeeService->getEmployeeById($id);
    return view('panels.employees.cellphone', [
        'employee' => $employee,
        'cellphones' => $employee->cellphones
    ]);
}

public function storeCellphone(Request $request, $employee_id)
{
    $data = $request->validate([
        'cellphone' => 'required|string|min:7|max:15',
        'relationship' => 'required|string|max:36'
    ]);

    $this->employeeService->assignEmployeeCellphone(
        $employee_id,
        $data['cellphone'],
        $data['relationship']
    );

    return redirect()
        ->route('employee.phone', $employee_id)
        ->with('success', 'Teléfono agregado exitosamente.');
}

public function updateCellphone(Request $request, $employee_id)
{
    $data = $request->validate([
        'cellphone' => 'required|string|min:7|max:15',
        'relationship' => 'required|string|max:36',
        'id' => 'required|string'
    ]);

    $this->employeeService->updateEmployeeCellphone(
        $employee_id,
        $data['id'],
        $data['cellphone'],
        $data['relationship']
    );

    return redirect()
        ->route('employee.phone', $employee_id)
        ->with('success', 'Teléfono actualizado exitosamente.');
}

public function deleteCellphone(Request $request, $employee_id)
{
    $data = $request->validate([
        'id' => 'required|string'

    ]);
    $this->employeeService->removeEmployeeCellphone($employee_id, $data['id']);
    
    return redirect()
        ->route('employee.phone', $employee_id)
        ->with('success', 'Teléfono eliminado exitosamente.');
}

}
