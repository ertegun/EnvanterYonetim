<?php
namespace App\Models\Vehicle;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
class Vehicle extends Model
{
    protected $table="vehicle";
    public function getOwner()
    {
        return $this->hasOneThrough(
            User::class,
            VehicleOwner::class,
            'vehicle_id',
            'id',
            'id',
            'owner_id'
        );
    }
    public function getModel(){
        return $this->hasOne(VehicleModel::class,'id','model_id');
    }
}
