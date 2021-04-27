<?php

namespace App\Models\Material;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table="material";
    public function getOwner(){
        return $this->hasOneThrough(
            User::class,
            MaterialOwner::class,
            'material_id',
            'id',
            'id',
            'owner_id'
        );
    }
    public function getType(){
        return $this->hasOne(MaterialType::class,'id','type_id');
    }
}
