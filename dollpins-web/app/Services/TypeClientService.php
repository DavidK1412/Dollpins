<?php

namespace App\Services;

use App\Repositories\TypeClientRepository;

class TypeClientService
{
    protected $typeClientRepository;

    public function __construct(TypeClientRepository $typeClientRepository)
    {
        $this->typeClientRepository = $typeClientRepository;
    }

    public function getAllTypeClients()
    {
        return $this->typeClientRepository->getAllTypeClients();
    }

    public function getTypeClientById($id)
    {
        return $this->typeClientRepository->getTypeClientById($id);
    }

}
