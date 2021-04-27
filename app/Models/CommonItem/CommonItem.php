<?php

namespace App\Models\CommonItem;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class CommonItem extends Model
{
    protected $table="common_item";
    public function getType()
    {
        return $this->hasOne(CommonItemType::class,'id','type_id');
    }
    public function getOwners(){
        return $this->hasManyThrough(
            User::class,
            CommonItemOwner::class,
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
