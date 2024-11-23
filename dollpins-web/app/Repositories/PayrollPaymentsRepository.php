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

    public function create($data)
    {
        return PayrollPayments::create($data);
    }

    public function update($id, $data)
    {
        return PayrollPayments::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return PayrollPayments::where('id', $id)->delete();
    }

    public function get($id)
    {
        return PayrollPayments::where('id', $id)->first();
    }

    public function all()
    {
        return PayrollPayments::all();
    }

}
