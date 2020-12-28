<?php

namespace App\Models\Material;
use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    protected $table="material_type";
    public function getUsingItems()
    {
        return $this->hasManyThrough(
            'App\Models\Material\MaterialOwner',
            'App\Models\Material\Material',
            'type_id',
            'material_id',
            'id',
            'id',
        );
    }
    public function getUsingItemsCount()
    {
        return count($this->getUsingItems);
    }
    public function getItems(){
        return $this->hasMany('App\Models\Material\Material','type_id','id');
    }
    public function getItemsCount()
    {
        return count($this->getItems);
    }
    public function getUseableItemsCount(){
        return ($this->getItemsCount()-$this->getUsingItemsCount());
    }
}
