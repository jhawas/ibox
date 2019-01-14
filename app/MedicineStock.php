<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineStock extends Model
{

    public function medicine() {
        return $this->belongsTo('App\TypeOfCharge', 'type_of_charge_id');
    }

    public function massVolumeType() {
        return $this->belongsTo('App\MassVolumeType');
    }
}
