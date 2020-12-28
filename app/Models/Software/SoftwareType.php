<?php

namespace App\Models\Software;
use Illuminate\Database\Eloquent\Model;

class SoftwareType extends Model
{
    protected $table="software_type";
    public function getUsingItems()
    {
        return $this->hasManyThrough(
            'App\Models\Software\SoftwareOwner',
            'App\Models\Software\Software',
            'type_id',
            'software_id',
            'id',
            'id',
        );
    }
    public function getUsingItemsCount()
    {
        return count($this->getUsingItems);
    }
    public function getItems(){
        return $this->hasMany('App\Models\Software\Software','type_id','id');
    }
    public function getItemsCount()
    {
        return count($this->getItems);
    }
    public function getUseableItemsCount(){
        return ($this->getItemsCount()-$this->getUsingItemsCount());
    }
}
