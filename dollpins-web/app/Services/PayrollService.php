<?php

namespace App\Services;

use App\Repositories\PayrollRepository;
use App\Repositories\PaymentAddonRepository;
use App\Repositories\PayrollPaymentsRepository;

use Illuminate\Support\Str;


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
        return $this->payrollRepository->getPayRollById($id);
    }

    public function createPayroll($data)
    {
        $data['id'] = Str::uuid();

        return $this->payrollRepository->createPayRoll($data);
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
        return $this->payrollRepository->getPayRolls();
    }

    public function getPaymentsByPayrollId($id)
    {
        return $this->payrollPaymentsRepository->getPayrollPaymentsByPayrollId($id);
    }

    public function createPaymentAddon($data)
    {
        $data['id'] = Str::uuid();

        return $this->paymentAddonRepository->createPaymentAddon($data);
    }

    public function getPayment($id)
    {
        return $this->payrollPaymentsRepository->getPayrollPayments($id);
    }

    public function createPayment($data)
    {
        $data['id'] = Str::uuid();
        $data['payment_date'] = now();

        return $this->payrollPaymentsRepository->createPayrollPayments($data);
    }

    public function updatePayment($id, $data)
    {
        return $this->payrollPaymentsRepository->updatePayrollPayments($id, $data);
    }

    public function getPaymentAddons($id)
    {
        return $this->paymentAddonRepository->getPaymentAddonsByPaymentId($id);
    }

}
