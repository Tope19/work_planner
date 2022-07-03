<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $table = 'timetables';

    protected $fillable = [
        'name',
        'start_time',
        'end_time'
    ];
}
