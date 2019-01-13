<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientRecord extends Model
{
    public function user() {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function recordType() {
    	return $this->belongsTo('App\RecordType', 'record_type_id');
    }

    public function room() {
    	return $this->belongsTo('App\Room', 'room_id');
    }
}
