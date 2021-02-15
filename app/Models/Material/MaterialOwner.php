<?php

namespace App\Models\Material;
use Illuminate\Database\Eloquent\Model;

class MaterialOwner extends Model
{
    protected $table="material_owner";
    public $timestamps = false;
    public function getInfo(){
        return $this->hasOne('App\Models\Material\Material','id','material_id');
    }
}
