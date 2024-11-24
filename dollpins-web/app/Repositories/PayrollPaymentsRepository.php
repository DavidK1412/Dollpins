<?php

namespace App\Repositories;

use App\Models\PayrollPayments;

class PayrollPaymentsRepository
{
    private $payrollPayments;

    public function __construct(PayrollPayments $payrollPayments)
    {
        $this->payrollPayments = $payrollPayments;
    }

    public function getPayrollPayments($id)
    {
        return $this->payrollPayments->find($id);
    }

    public function createPayrollPayments($data)
    {
        return $this->payrollPayments->create($data);
    }

    public function updatePayrollPayments($id, $data)
    {
        return $this->payrollPayments->where('id', $id)->update($data);
    }

    public function deletePayrollPayments($id)
    {
        return $this->payrollPayments->where('id', $id)->delete();
    }

    public function getPayrollPaymentsByPayrollId($payroll_id)
    {
        return $this->payrollPayments->where('payroll_id', $payroll_id)->get();
    }

}
