<?php
namespace App\Models\Hardware;
use Illuminate\Database\Eloquent\Model;
class HardwareType extends Model
{
    protected $table="hardware_type";
    public function getUsingItems()
    {
        return $this->hasManyThrough(
            HardwareOwner::class,
            Hardware::class,
            'type_id',
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
        return $this->hasMany(Hardware::class,'type_id','id');
    }
    public function getItemsCount()
    {
        return count($this->getItems);
    }
    public function getUseableItemsCount(){
        return ($this->getItemsCount()-$this->getUsingItemsCount());
    }
}
