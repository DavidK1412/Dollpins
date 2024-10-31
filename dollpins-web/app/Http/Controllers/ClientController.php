<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClientService;

class ClientController extends Controller
{
    protected ClientService $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function showClients()
    {
        $clients = $this->clientService->getAllClients();
        return view('panels.clients.search', compact('clients'));
    }

    public function showClient($id)
    {
        $client = $this->clientService->getClientById($id);
        return view('panels.clients.show', compact('client'));
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
        $this->clientService->createClient($data);

        return redirect()->route('clients.index');
    }

    public function updateClient(Request $request, $id)
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

        $this->clientService->updateClient($id, $data);
        return redirect()->route('clients.index');
    }

    public function deleteClient($id)
    {
        $this->clientService->deleteClient($id);
        return redirect()->route('clients.index');
    }

}
