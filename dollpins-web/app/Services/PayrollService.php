<?php

namespace App\Services;

use App\Repositories\PayrollRepository;
use App\Repositories\PaymentAddonRepository;
use App\Repositories\PayrollPaymentsRepository;

class PayrollService
{
    private $payrollRepository;
    private $paymentAddonRepository;
    private $payrollPaymentsRepository;

    public function __construct(PayrollRepository $payrollRepository, PaymentAddonRepository $paymentAddonRepository, PayrollPaymentsRepository $payrollPaymentsRepository)
    {
        $this->payrollRepository = $payrollRepository;
        $this->paymentAddonRepository = $paymentAddonRepository;
        $this->payrollPaymentsRepository = $payrollPaymentsRepository;
    }

    public function getPayroll($id)
    {
        return $this->payrollRepository->getPayroll($id);
    }

    public function createPayroll($data)
    {
        return $this->payrollRepository->createPayroll($data);
    }

    public function updatePayroll($id, $data)
    {
        return $this->payrollRepository->updatePayroll($id, $data);
    }

    public function deletePayroll($id)
    {
        return $this->payrollRepository->deletePayroll($id);
    }

    public function getAll()
    {
        return $this->payrollRepository->all();
    }

}
