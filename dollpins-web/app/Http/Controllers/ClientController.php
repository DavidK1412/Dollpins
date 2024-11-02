<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClientService;
use App\Services\CityService;
use App\Services\TypeClientService;

class ClientController extends Controller
{
    protected $clientService;
    protected $cityService;
    protected $typeClientService;

    public function __construct(ClientService $clientService, CityService $cityService, TypeClientService $typeClientService)
    {
        $this->clientService = $clientService;
        $this->cityService = $cityService;
        $this->typeClientService = $typeClientService;
    }

    public function showClients()
    {
        $clients = $this->clientService->getAllClients();
        return view('panels.clients.search', compact('clients'));
    }

    public function showClient($id)
    {
        $client = $this->clientService->getClientById($id);
        $city = $this->cityService->getCityById($client->id_city);
        $typeClient = $this->typeClientService->getTypeClientById($client->id_type_client);
        $data = [
            'client' => $client,
            'city' => $city,
            'typeClient' => $typeClient
        ];

        return view('panels.clients.show', compact('data'));
    }

    public function createClient(Request $request)
    {
        $data = $request->validate([
            'id_type_client' => 'required',
            'name' => 'required',
            'document' => 'required',
            'cellphone' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'mail' => 'required',
            'id_city' => 'required'
        ]);
        $data['status'] = 1;
        $this->clientService->createClient($data);

        return redirect()->route('clients.index')
            ->with('success', 'Client created successfully.');
    }

    public function updateClient(Request $request, $id)
    {
        $data = $request->validate([
            'id_type_client' => 'required',
            'name' => 'required',
            'cellphone' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'mail' => 'required',
            'id_city' => 'required'
        ]);

        $this->clientService->updateClient($id, $data);
        return redirect()->route('clients.index')
            ->with('success', 'Client updated successfully.');
    }

    public function deleteClient()
    {
        $id = request('id');
        $this->clientService->deleteClient($id);
        return redirect()->route('clients.index')
            ->with('success', 'Client deleted successfully.');
    }

    public function showCreateForm()
    {
        $data = [
            'cities' => $this->cityService->getAll(),
            'typeClients' => $this->typeClientService->getAllTypeClients()
        ];

        return view('panels.clients.create', compact('data'));
    }

    public function showEditForm($id)
    {
        $client = $this->clientService->getClientById($id);
        $data = [
            'client' => $client,
            'cities' => $this->cityService->getAll(),
            'typeClients' => $this->typeClientService->getAllTypeClients()
        ];

        return view('panels.clients.edit', compact('data'));
    }

}
