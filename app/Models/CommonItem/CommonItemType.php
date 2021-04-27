<?php

namespace App\Models\CommonItem;
use Illuminate\Database\Eloquent\Model;

class CommonItemType extends Model
{
    protected $table="common_item_type";
    public function getUsingItems()
    {
        return $this->hasManyThrough(
            CommonItemOwner::class,
            CommonItem::class,
            'id',
            'common_item_id',
            'id',
            'type_id',
        );
    }
    public function getUsingItemsCount()
    {
        return count($this->getUsingItems);
    }
    public function getItems(){
        return $this->hasMany(CommonItem::class,'type_id','id');
    }
    public function getItemsCount()
    {
        return count($this->getItems);
    }
    public function getUseableItemsCount(){
        return ($this->getItemsCount()-$this->getUsingItemsCount());
    }
}
