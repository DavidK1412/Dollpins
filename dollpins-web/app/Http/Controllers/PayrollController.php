<?php

namespace App\Http\Controllers;

use App\Services\PayrollService;
use App\Services\EmployeeService;
use App\Services\TransactionsService;

use Illuminate\Http\Request;

class PayrollController
{
    protected PayrollService $payrollService;
    protected EmployeeService $employeeService;
    protected TransactionsService $transactionsService;

    public function __construct(PayrollService $payrollService, EmployeeService $employeeService, TransactionsService $transactionsService)
    {
        $this->payrollService = $payrollService;
        $this->employeeService = $employeeService;
        $this->transactionsService = $transactionsService;
    }

    public function index()
    {
        $payrolls = $this->payrollService->getAll();
        return view('panels.payroll.index', compact('payrolls'));
    }

    public function showCreateForm()
    {
        $employees = $this->employeeService->getAllEmployees();
        return view('panels.payroll.create', compact('employees'));
    }

    public function create(Request $request)
    {
        $data = $request->validate(
            [
                'employee_id' => 'required|string',
                'salary' => 'required|numeric',
            ]
        );

        $this->payrollService->createPayroll($data);

        return redirect()->route('payrolls.index');
    }

    public function detail($id)
    {
        $payroll = $this->payrollService->findById($id);
        return view('payrolls.detail', compact('payroll'));
    }

    public function showEditForm($id)
    {
        $payroll = $this->payrollService->getPayroll($id);
        return view('panels.payroll.edit', compact('payroll'));
    }

    public function edit(Request $request, $id)
    {
        $data = $request->validate(
            [
                'salary' => 'required|numeric',
            ]
        );

        $this->payrollService->updatePayroll($id, $data);

        return redirect()->route('payrolls.index')->with(
            'success',
            'Nómina actualizada'
        );
    }

    public function payrollPayments($payroll_id) {
        $payments = $this->payrollService->getPaymentsByPayrollId($payroll_id);
        $payroll = $this->payrollService->getPayroll($payroll_id);

        return view('panels.payroll.detail', compact('payroll', 'payments'));
    }

    public function showPaymentForm($payroll_id)
    {
        $payroll = $this->payrollService->getPayroll($payroll_id);
        $data = [
            'payroll_id' => $payroll_id,
            'amount' => $payroll->salary,
        ];
        $payrollPayment = $this->payrollService->createPayment($data);

        return view('panels.payroll.create_payment', compact('payroll', 'payrollPayment'));
    }

    public function showPaymentAddonForm($payment_id)
    {
        $payrollPayment = $this->payrollService->getPayment($payment_id);
        $paymentAddons = $this->payrollService->getPaymentAddons($payment_id);
        $payroll = $this->payrollService->getPayroll($payrollPayment->payroll_id);

        return view('panels.payroll.create_payment_addon', compact('payrollPayment', 'paymentAddons', 'payroll'));
    }

    public function storePaymentAddon(Request $request, $payment_id)
    {

        $data = $request->validate(
            [
                'amount' => 'required|numeric',
                'description' => 'required|string',
            ]
        );
        $data['payment_id'] = $payment_id;

        $this->payrollService->createPaymentAddon($data);
        $payment = $this->payrollService->getPayment($payment_id);
        $payment->amount += $data['amount'];
        $payment->save();


        return redirect()->route('payrolls.newPaymentAddon',
            [
                'payment_id' => $payment_id,
            ])->with(
            'success',
            'Complemento creado'
        );
    }

    public function processPayment($payment_id)
    {
        $payment = $this->payrollService->getPayment($payment_id);
        $transactionData = [
            'amount' => $payment->amount,
            'description' => 'Pago de nómina a ' . $payment->payroll->employee->name. ' en la fecha ' . $payment->payment_date ,
            'type_id' => 3,
        ];
        $this->transactionsService->createTransaction($transactionData);

        return redirect()->route('payrolls.detail', ['id' => $payment->payroll_id]);
    }

    public function paymentDetail($payment_id)
    {
        $payrollPayment = $this->payrollService->getPayment($payment_id);
        $paymentAddons = $this->payrollService->getPaymentAddons($payment_id);
        $payroll = $this->payrollService->getPayroll($payrollPayment->payroll_id);

        return view('panels.payroll.detail_payment', compact('payrollPayment', 'paymentAddons', 'payroll'));
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
