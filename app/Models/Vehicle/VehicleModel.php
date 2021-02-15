<?php
namespace App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
class VehicleModel extends Model
{
    protected $table="vehicle_model";
    public function getUsingItems()
    {
        return $this->hasManyThrough(
            'App\Models\Vehicle\VehicleOwner',
            'App\Models\Vehicle\Vehicle',
            'model_id',
            'vehicle_id',
            'id',
            'id',
        );
    }
    public function getUsingItemsCount()
    {
        return count($this->getUsingItems);
    }
    public function getItems(){
        return $this->hasMany('App\Models\Vehicle\Vehicle','model_id','id');
    }
    public function getItemsCount()
    {
        return count($this->getItems);
    }
    public function getUseableItemsCount(){
        return ($this->getItemsCount()-$this->getUsingItemsCount());
    }
}
