<?php

namespace App\Models\Software;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $table="software";
    public $timestamps = false;
    public function getOwner(){
        return $this->hasOneThrough(
            User::class,
            SoftwareOwner::class,
            'software_id',
            'id',
            'id',
            'owner_id'
        );
    }
    public function getType(){
        return $this->hasOne(SoftwareType::class,'id','type_id');
    }
}
