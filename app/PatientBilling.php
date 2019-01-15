<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientBilling extends Model
{
    public function charge() {
        return $this->belongsTo('App\TypeOfCharge', 'type_of_charge_id');
    }

    public function records() {
        return $this->belongsTo('App\PatientRecord', 'patient_record_id');
    }
}
