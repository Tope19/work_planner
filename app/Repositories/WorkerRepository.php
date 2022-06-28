<?php

namespace App\Repositories;

use App\Models\Worker;

class WorkerRepository
{
    protected $worker;

    public function __construct(Worker $worker)
    {
        $this->worker = $worker;
    }

    public function create(array $data)
    {
        return $this->worker->create($data);
    }

    public function getAll()
    {
        return $this->worker->all();
    }

    public function getById($id)
    {
        return $this->worker->find($id);
    }

}
