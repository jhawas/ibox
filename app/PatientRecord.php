<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientRecord extends Model
{
    public function user() {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function recordType() {
    	return $this->belongsTo('App\TypeOfCharge', 'type_of_charge_id');
    }

    public function room() {
    	return $this->belongsTo('App\Room', 'room_id');
    }

    public function billings() {
        return $this->hasMany('App\PatientBilling');
    }

    public function diagnoses() {
        return $this->hasMany('App\PatientDiagnose');
    }
}
