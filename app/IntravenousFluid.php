<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntravenousFluid extends Model
{
    public function record() {
    	return $this->belongsTo('App\PatientRecord', 'patient_record_id');
    }

}
