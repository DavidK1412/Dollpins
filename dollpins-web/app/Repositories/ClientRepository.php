<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Support\Facades\DB;

class ClientRepository
{

        protected Client $client;

        public function __construct(Client $client)
        {
            $this->client = $client;
        }

        public function all()
        {
            return $this->client->all();
        }

        public function create(array $data)
        {
            return $this->client->create($data);
        }

        public function findById($id)
        {
            return $this->client->find($id);
        }

        public function update($id, array $data)
        {
            return $this->client->where('id', $id)->update($data);
        }

        public function delete($id)
        {
            return $this->client->where('id', $id)->update(['status' => 2]);
        }
}
