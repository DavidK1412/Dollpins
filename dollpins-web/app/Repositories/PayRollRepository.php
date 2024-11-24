<?php

namespace App\Repositories;

use App\Models\Payroll;

class PayRollRepository
{
    private $payroll;

    public function __construct(PayRoll $payroll)
    {
        $this->payroll = $payroll;
    }


    public function getPayRolls()
    {
        return $this->payroll->all();
    }

    public function getPayRollById($id)
    {
        return $this->payroll->find($id);
    }

    public function createPayRoll($data)
    {
        return $this->payroll->create($data);
    }

    public function updatePayroll($id, $data)
    {
        return $this->payroll->where('id', $id)->update($data);
    }

}
