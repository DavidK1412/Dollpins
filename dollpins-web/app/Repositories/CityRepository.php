<?php

namespace App\Repositories;

use App\Models\city;

class CityRepository
{

    protected city $city;

    public function __construct(city $city)
    {
        $this->city = $city;
    }

    public function all()
    {
        return $this->city->all();
    }

}
