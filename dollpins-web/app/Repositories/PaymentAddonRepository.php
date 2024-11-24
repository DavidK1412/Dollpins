<?php

namespace App\Repositories;

use App\Models\PaymentAddon;

class PaymentAddonRepository
{

    private $paymentAddon;

    public function __construct(PaymentAddon $paymentAddon)
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

    public function getPaymentAddonsByPaymentId($payment_id)
    {
        return $this->paymentAddon->where('payment_id', $payment_id)->get();
    }

}
