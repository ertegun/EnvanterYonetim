<?php

namespace App\Models\Software;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $table="software";
    public $timestamps = false;
    public function getOwner(){
        return $this->hasOneThrough(
            'App\Models\User\User',
            'App\Models\Software\SoftwareOwner',
            'software_id',
            'id',
            'id',
            'owner_id'
        );
    }
    public function getType(){
        return $this->hasOne('App\Models\Software\SoftwareType','id','type_id');
    }
}
