<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reset extends Model
{
    protected $table="reset_password";
    /*public function getAdmin(){
        return $this->hasOne('App\Models\Admin\Admin','id','admin_id');
    }*/
}
