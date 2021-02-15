<?php
namespace App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
class Vehicle extends Model
{
    protected $table="vehicle";
    public function getOwner()
    {
        return $this->hasOneThrough(
            'App\Models\User\User',
            'App\Models\Vehicle\VehicleOwner',
            'vehicle_id',
            'id',
            'id',
            'owner_id'
        );
    }
    public function getModel(){
        return $this->hasOne('App\Models\Vehicle\VehicleModel','id','model_id');
    }
}
