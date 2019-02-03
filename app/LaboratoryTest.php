<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaboratoryTest extends Model
{
    public function record() {
    	return $this->belongsTo('App\PatientRecord', 'patient_record_id');
    }

    public function laboratory() {
    	return $this->belongsTo('App\TypeOfLaboratory', 'type_of_laboratory_id');
    }
}
