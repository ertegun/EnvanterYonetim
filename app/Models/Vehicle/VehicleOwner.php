<?php
namespace App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
class VehicleOwner extends Model
{
    protected $table="vehicle_owner";
    public $timestamps = false;

    public function getInfo(){
        return $this->hasOne('App\Models\Vehicle\Vehicle','id','vehicle_id');
    }
}
