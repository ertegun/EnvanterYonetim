<?php
namespace App\Models\Vehicle;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
class VehicleOwner extends Model
{
    protected $table="vehicle_owner";
    public $timestamps = false;

    public function getOwner()
    {
        return $this->hasOne(User::class,'id','owner_id');
    }

    public function getInfo(){
        return $this->hasOne(Vehicle::class,'id','vehicle_id');
    }
}
