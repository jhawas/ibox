<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorsOrder extends Model
{
    public function record() {
    	return $this->belongsTo('App\PatientRecord', 'patient_record_id');
    }

    public function user() {
    	return $this->belongsTo('App\User', 'physician_id');
    }
}
