<?php

namespace App\Repositories;

use App\Models\PaymentAddon;

class PaymentAddonRepository
{
    private $paymentAddon;

    public function __construct(PaymentAddonRepository $paymentAddon)
    {
        $this->paymentAddon = $paymentAddon;
    }

    public function getPaymentAddon($id)
    {
        return $this->paymentAddon->find($id);
    }

    public function createPaymentAddon($data)
    {
        return $this->paymentAddon->create($data);
    }

    public function updatePaymentAddon($id, $data)
    {
        return $this->paymentAddon->where('id', $id)->update($data);
    }

    public function deletePaymentAddon($id)
    {
        return $this->paymentAddon->where('id', $id)->delete();
    }

}
