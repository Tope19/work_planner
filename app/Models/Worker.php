<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    //
    protected $fillable = [
        'name',
        'email'
    ];

    public function shifts(){
        return $this->hasMany(Shift::class);
    }
}
