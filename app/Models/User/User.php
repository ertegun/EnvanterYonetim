<?php
namespace App\Models\User;
use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    protected $table="user";
    public function getDepartment()
    {
        return $this->hasOne('App\Models\User\Department','id','department_id');
    }

    public function getHardware()
    {
        return $this->hasMany('App\Models\Hardware\HardwareOwner','owner_id');
    }
    public function getHardwareCount()
    {
        return $this->getHardware->count();
    }

    public function getSoftware()
    {
        return $this->hasMany('App\Models\Software\SoftwareOwner','owner_id');
    }
    public function getSoftwareCount()
    {
        return $this->getSoftware->count();
    }

    public function getMaterial()
    {
        return $this->hasMany('App\Models\Material\MaterialOwner','owner_id');
    }
    public function getMaterialCount()
    {
        return $this->getMaterial->count();
    }

    public function getCommon()
    {
        return $this->hasMany('App\Models\CommonItem\CommonItemOwner','owner_id');
    }
    public function getCommonCount()
    {
        return $this->getCommon->count();
    }
}
