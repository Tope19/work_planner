<?php

namespace App\Repositories;

use App\Models\Timestable;

class TimestableRepository
{
    protected $time;

    public function __construct(Timestable $time)
    {
        $this->time = $time;
    }

    public function create(array $data)
    {
        return $this->time->create($data);
    }

    public function getAll()
    {
        return $this->time->all();
    }

    public function getById($id)
    {
        return $this->time->find($id);
    }

}
