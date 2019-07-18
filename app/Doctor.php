<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public function doctor_pets()
    {
        return $this->hasMany('App\Pet', 'doctor_id', 'id');
    }
}
