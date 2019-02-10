<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOfCharge extends Model
{
    public function type() {
        return $this->belongsTo('App\Type', 'type_id');
    }

    public function parent() {
    	return $this->belongsTo('App\TypeOfCharge', 'parent_id');
    }

    public function billings() {
    	return $this->hasMany('App\PatientBilling');
    }

    public function child() {
    	return $this->hasMany('App\TypeOfCharge', 'parent_id');
    }
}
