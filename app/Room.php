<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'floor_id',
        'room_type_id',
        'code',
        'capacity',
        'description',
    ];

    public function room_type() {
        return $this->belongsTo('App\TypeOfCharge', 'type_of_charge_id');
    }

    public function floor() {
        return $this->belongsTo('App\Floor', 'floor_id');
    }

    public function records() {
        return $this->hasMany('App\PatientRecord');
    }

}
