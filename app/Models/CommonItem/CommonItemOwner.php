<?php

namespace App\Models\CommonItem;
use Illuminate\Database\Eloquent\Model;

class CommonItemOwner extends Model
{
    protected $table="common_item_owner";
    public function getInfo(){
        return $this->hasOne(CommonItem::class,'id','common_item_id');
    }
}
