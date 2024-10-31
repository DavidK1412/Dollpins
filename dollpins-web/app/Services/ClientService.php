<?php

namespace App\Services;

use App\Repositories\ClientRepository;
use Illuminate\Support\Str;

class ClientService
{
    protected ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function getAllClients()
    {
        return $this->clientRepository->all();
    }

    public function createClient(array $data)
    {
        $data['id'] = Str::uuid();

        return $this->clientRepository->create($data);
    }

    public function getClientById($id)
    {
        return $this->clientRepository->findById($id);
    }

    public function updateClient($id, array $data)
    {
        return $this->clientRepository->update($id, $data);
    }

    public function deleteClient($id)
    {
        return $this->clientRepository->delete($id);
    }
}
