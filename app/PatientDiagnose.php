<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientDiagnose extends Model
{
    public function diagnose() {
        return $this->belongsTo('App\Diagnose', 'diagnose_id');
    }

    public function record() {
        return $this->belongsTo('App\PatientRecord', 'patient_record_id');
    }
}
