<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineStock extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 
        'description', 
        'quantity', 
        'price', 
        'medicine_type_id', 
        'mass_volume_type_id',
        'user_id',
    ];

    public function medicineType() {
        return $this->belongsTo('App\MedicineType');
    }

    public function massVolumeType() {
        return $this->belongsTo('App\MassVolumeType');
    }
}
