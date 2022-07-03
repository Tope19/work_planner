<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
        'worker_id',
        'timetable_id',
    ];

    public function workers()
    {
        return $this->belongsTo(Worker::class, 'worker_id');
    }


    public function timetables()
    {
        return $this->belongsTo(Timetable::class, 'timetable_id');
    }
}
