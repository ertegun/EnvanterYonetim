<?php

namespace App\Models\Material;

use Illuminate\Database\Eloquent\Model;

class MaterialOwner extends Model
{
    protected $table="material_owner";
<<<<<<< Updated upstream
=======
    public $timestamps = false;

>>>>>>> Stashed changes
    public function getInfo(){
        return $this->hasOne(Material::class,'id','material_id');
    }
}
