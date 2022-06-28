<?php

namespace App\Services;

use Carbon\Carbon;
use App\Repositories\WorkerRepository;

class WorkerService
{
    protected $workerRepository;

    public function __construct(WorkerRepository $workerRepository)
    {
        $this->workerRepository = $workerRepository;
    }


    public function create(array $data)
    {
        $worker = $this->workerRepository->create($data);
        return $worker;

    }

    public  function getAll()
    {
        $workers = $this->workerRepository->getAll();
        return $workers;

    }

    public function getById($id)
    {
        $worker = $this->workerRepository->getById($id);
        return $worker;
    }

}
