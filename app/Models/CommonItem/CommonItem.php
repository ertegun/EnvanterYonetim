<?php

namespace App\Models\CommonItem;
use Illuminate\Database\Eloquent\Model;

class CommonItem extends Model
{
    protected $table="common_item";
    public function getType()
    {
        return $this->hasOne('App\Models\CommonItem\CommonItemType','id','type_id');
    }
    public function getOwners(){
        return $this->hasManyThrough(
            'App\Models\User\User',
            'App\Models\CommonItem\CommonItemOwner',
            'common_item_id',
            'id',
            'id',
            'owner_id'
        );
    }
    public function getOwnerCount()
    {
        return count($this->owner_count);
    }
}
