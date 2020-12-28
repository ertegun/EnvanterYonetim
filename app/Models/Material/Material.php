<?php

namespace App\Models\Material;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table="material";
    public function getOwner(){
        return $this->hasOneThrough(
            'App\Models\User\User',
            'App\Models\Material\MaterialOwner',
            'material_id',
            'id',
            'id',
            'owner_id'
        );
    }
    public function getType(){
        return $this->hasOne('App\Models\Material\MaterialType','id','type_id');
    }
}
