<?php

namespace App\Repositories;

use App\Models\City;

class CityRepository
{

    protected City $city;

    public function __construct(City $city)
    {
        $this->city = $city;
    }

    public function all()
    {
        return $this->city->all();
    }

    public function findById($id)
    {
        return $this->city->find($id);
    }

}
