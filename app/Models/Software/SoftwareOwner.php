<?php

namespace App\Models\Software;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class SoftwareOwner extends Model
{
    protected $table="software_owner";
    public $timestamps = false;
    public function getOwner()
    {
        return $this->hasOne(User::class,'id','owner_id');
    }
    public function getInfo(){
        return $this->hasOne(Software::class,'id','software_id');
    }
}
