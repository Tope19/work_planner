<?php

namespace App\Services;

use Carbon\Carbon;
use App\Repositories\TimetableRepository;

class TimetableService
{
    protected $timeRepository;

    public function __construct(TimetableRepository $timeRepository)
    {
        $this->timeRepository = $timeRepository;
    }


    public function create(array $data)
    {
        $time = $this->timeRepository->create($data);
        return $time;

    }

    public  function getAll()
    {
        $time = $this->timeRepository->getAll();
        return $time;

    }

    public function getById($id)
    {
        $time = $this->timeRepository->getById($id);
        return $time;
    }

}
