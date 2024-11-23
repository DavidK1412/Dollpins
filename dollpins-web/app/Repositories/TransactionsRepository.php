<?php

namespace App\Repositories;

use App\Models\Transactions;

class TransactionsRepository
{
    private $transactions;

    public function __construct(Transactions $transactions)
    {
        $this->transactions = $transactions;
    }

    public function getTransactions($id)
    {
        return $this->transactions->find($id);
    }

    public function createTransactions($data)
    {
        return $this->transactions->create($data);
    }

    public function updateTransactions($id, $data)
    {
        return $this->transactions->where('id', $id)->update($data);
    }

    public function deleteTransactions($id)
    {
        return $this->transactions->where('id', $id)->delete();
    }

}
