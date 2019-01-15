<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function typeOfCharges() {
        return $this->hasMany('App\TypeOfCharge');
    }
}
