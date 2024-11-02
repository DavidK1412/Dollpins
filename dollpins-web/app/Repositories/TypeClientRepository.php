<?php

namespace App\Repositories;

use App\Models\TypeClient;

class TypeClientRepository
{
    protected TypeClient $typeClient;

    public function __construct(TypeClient $typeClient)
    {
        $this->typeClient = $typeClient;
    }

    public function getAllTypeClients()
    {
        return $this->typeClient->all();
    }

    public function getTypeClientById($id)
    {
        return $this->typeClient->find($id);
    }

}
