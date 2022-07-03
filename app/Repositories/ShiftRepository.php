<?php

namespace App\Repositories;

use App\Models\Shift;

class ShiftRepository
{
    protected $shift;

    public function __construct(Shift $shift)
    {
        $this->shift = $shift;
    }

    public function create(array $data)
    {
        return $this->shift->create($data);
    }

    public function getAll()
    {
        return $this->shift->all();
    }

    public function getById($id)
    {
        return $this->shift->find($id);
    }


}
