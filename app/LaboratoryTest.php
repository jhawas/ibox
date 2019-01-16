<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaboratoryTest extends Model
{
    public function record() {
    	return $this->belongsTo('App\PatientRecord', 'patient_record_id');
    }

    public function charge() {
    	return $this->belongsTo('App\TypeOfCharge', 'type_of_charge_id');
    }
}
