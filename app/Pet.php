<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    public function pets_doctor()
    {
        return $this->belongsTo('App\Doctor', 'doctor_id', 'id');
    }
}
