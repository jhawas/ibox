<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorsOrder extends Model
{
    public function record() {
    	return $this->belongsTo('App\PatientRecord', 'patient_record_id');
    }
}
