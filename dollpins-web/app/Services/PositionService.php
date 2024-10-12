<?php

namespace App\Services;

use App\Repositories\PositionRepository;

class PositionService
{
    protected $positionRepository;

    public function __construct(PositionRepository $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    public function getAllPositions()
    {
        $positions = $this->positionRepository->getAll();
        $positions->transform(function ($position) {
            $position->name = ucfirst(strtolower($position->name));
            return $position;
        });
        return $positions;

    }

}
