<?php

namespace App\Models\Software;
use Illuminate\Database\Eloquent\Model;

class SoftwareOwner extends Model
{
    protected $table="software_owner";
    public $timestamps = false;
    public function getOwner()
    {
        return $this->hasOne('App\Models\User\User','id','owner_id');
    }
    public function getInfo(){
        return $this->hasOne('App\Models\Software\Software','id','software_id');
    }
}
