<?php

namespace App\Repositories;

use App\Models\Timetable;

class TimetableRepository
{
    protected $time;

    public function __construct(Timetable $time)
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
