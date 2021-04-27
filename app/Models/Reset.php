<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reset extends Model
{
    protected $table="reset_password";
    /*public function getAdmin(){
        return $this->hasOne(Admin::class,'id','admin_id');
    }*/
}
