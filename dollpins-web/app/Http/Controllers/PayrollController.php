<?php

namespace App\Http\Controllers;

use App\Services\PayrollService;
use App\Services\EmployeeService;

class PayrollController
{
    protected PayrollService $payrollService;
    protected EmployeeService $employeeService;

    public function __construct(PayrollService $payrollService, EmployeeService $employeeService)
    {
        $this->payrollService = $payrollService;
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $payrolls = $this->payrollService->all();
        return view('payrolls.index', compact('payrolls'));
    }

    public function showCreateForm()
    {
        $employees = $this->employeeService->getAllEmployees();
        return view('payrolls.create', compact('employees'));
    }

    public function create(Request $request)
    {
        $data = $request->validate(
            [
                'employee_id' => 'required|integer',
                'amount' => 'required|numeric',
                'date' => 'required|date',
            ]
        );

        $this->payrollService->create($data);

        return redirect()->route('payrolls.index');
    }

    public function detail($id)
    {
        $payroll = $this->payrollService->findById($id);
        return view('payrolls.detail', compact('payroll'));
    }

    public function massPayment()
    {
        $employees = $this->employeeService->bulkPayments();
        return view('payrolls.mass-payment', compact('employees'));
    }

    public function paymentDetail($id)
    {
        $payrolls = $this->payrollService->getPaymentDetail($id);
        return view('payrolls.payment-detail', compact('employee', 'payrolls'));
    }

    public function pay()
    {
        $employees = $this->employeeService->bulkPayments();
        $this->payrollService->pay($employees);
        return redirect()->route('payrolls.index');
    }

    public function insertAddons(Request $request, $payment_id)
    {
        $data = $request->validate(
            [
                'amount' => 'required|numeric',
                'description' => 'required|date',
            ]
        );
        $data['payment_id'] = $payment_id;

        $this->payrollService->insertAddons($data);

        return redirect()->route('payrolls.index')->with(
            'success',
            'Complemento creado'
        );
    }

}
