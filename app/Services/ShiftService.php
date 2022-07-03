<?php

namespace App\Services;

use App\Repositories\ShiftRepository;

class ShiftService
{
    protected $shiftRepository;

    public function __construct(ShiftRepository $shiftRepository)
    {
        $this->shiftRepository = $shiftRepository;
    }


    public function create(array $data)
    {
        $shift = $this->shiftRepository->create($data);
        return $shift;
    }

    public  function getAll()
    {
        $shifts = $this->shiftRepository->getAll();
        return $shifts;

    }

    public function getById($id)
    {
        $shift = $this->shiftRepository->getById($id);
        return $shift;
    }

}
