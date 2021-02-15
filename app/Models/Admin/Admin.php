<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authendicatable;
class Admin extends Authendicatable
{
    protected $table="admin";
    public function getRole()
    {
        return $this->hasOne('App\Models\Admin\Role','id','role_id');
    }
}
