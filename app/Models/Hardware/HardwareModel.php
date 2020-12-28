<?php
namespace App\Models\Hardware;
use Illuminate\Database\Eloquent\Model;
class HardwareModel extends Model
{
    protected $table="hardware_model";
    public function getUsingItems()
    {
        return $this->hasManyThrough(
            'App\Models\Hardware\HardwareOwner',
            'App\Models\Hardware\Hardware',
            'model_id',
            'hardware_id',
            'id',
            'id',
        );
    }
    public function getUsingItemsCount()
    {
        return count($this->getUsingItems);
    }
    public function getItems(){
        return $this->hasMany('App\Models\Hardware\Hardware','model_id','id');
    }
    public function getItemsCount()
    {
        return count($this->getItems);
    }
    public function getUseableItemsCount(){
        return ($this->getItemsCount()-$this->getUsingItemsCount());
    }
}
