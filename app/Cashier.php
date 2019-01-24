<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    public function records() {
        return $this->belongsTo('App\PatientRecord', 'patient_record_id');
    }
}
