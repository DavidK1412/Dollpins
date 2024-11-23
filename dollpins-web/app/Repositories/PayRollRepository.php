<?php

namespace App\Repositories;

use App\Models\Payroll;

class PayRollRepository
{
    private $payroll;

    public function __construct(PayRollRepository $payroll)
    {
        $this->payroll = $payroll;
    }


    public function getPayRolls()
    {
        return PayRollRepository::all();
    }

    public function getPayRollById($id)
    {
        return PayRollRepository::find($id);
    }

    public function createPayRoll($data)
    {
        return PayRollRepository::create($data);
    }

    public function updatePayRoll($id, $data)
    {
        return PayRollRepository::find($id)->update($data);
    }

    public function deletePayRoll($id)
    {
        return PayRollRepository::destroy($id);
    }
}
