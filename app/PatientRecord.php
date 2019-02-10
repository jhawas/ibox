<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientRecord extends Model
{
    public function patient() {
    	return $this->belongsTo('App\Patient', 'patient_id');
    }

    public function recordType() {
    	return $this->belongsTo('App\TypeOfRecord', 'type_of_record_id');
    }

    public function room() {
    	return $this->belongsTo('App\Room', 'room_id');
    }

    public function disposition() {
        return $this->belongsTo('App\Disposition', 'disposition_id');
    }


    public function billings() {
        return $this->hasMany('App\PatientBilling');
    }

    public function diagnoses() {
        return $this->hasMany('App\PatientDiagnose');
    }

    public function vitalSigns() {
        return $this->hasMany('App\VitalSign');
    }

    public function doctorsOrders() {
        return $this->hasMany('App\DoctorsOrder');
    }

    public function nursesNotes() {
        return $this->hasMany('App\NursesNote');
    }

    public function intravenousFluids() {
        return $this->hasMany('App\IntravenousFluid');
    }

    public function medicationAndTreatments() {
        return $this->hasMany('App\MedicationAndTreatment');
    }

    public function physician() {
        return $this->belongsTo('App\User', 'attending_physician');
    }

}
