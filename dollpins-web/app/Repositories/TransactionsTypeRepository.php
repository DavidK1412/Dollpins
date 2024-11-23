<?php

namespace App\Repositories;

use App\Models\TransactionsType;

class TransactionsTypeRepository
{
    private $transactionsType;

    public function __construct(TransactionsType $transactionsType)
    {
        $this->transactionsType = $transactionsType;
    }

    public function getTransactionsType($id)
    {
        return $this->transactionsType->find($id);
    }

    public function createTransactionsType($data)
    {
        return $this->transactionsType->create($data);
    }

    public function updateTransactionsType($id, $data)
    {
        return $this->transactionsType->where('id', $id)->update($data);
    }

    public function deleteTransactionsType($id)
    {
        return $this->transactionsType->where('id', $id)->delete();
    }

}
