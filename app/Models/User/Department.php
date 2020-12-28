<?php
namespace App\Models\User;
use Illuminate\Database\Eloquent\Model;
class Department extends Model
{
    protected $table="department";
    public function getUser()
    {
        return $this->hasMany('App\Models\User\User','department_id','id');
    }
    public function getUserCount()
    {
        return count($this->getUser);
    }
    public function getHardware()
    {
        return $this->hasManyThrough(
            'App\Models\Hardware\HardwareOwner',
            'App\Models\User\User',
            'department_id',
            'owner_id',
            'id',
            'id'
        );
    }
    public function getHardwareCount(){
        return count($this->getHardware);
    }
    public function getSoftware()
    {
        return $this->hasManyThrough(
            'App\Models\Software\SoftwareOwner',
            'App\Models\User\User',
            'department_id',
            'owner_id',
            'id',
            'id'
        );
    }
    public function getSoftwareCount(){
        return count($this->getSoftware);
    }
    public function getCommon()
    {
        return $this->hasManyThrough(
            'App\Models\CommonItem\CommonItemOwner',
            'App\Models\User\User',
            'department_id',
            'owner_id',
            'id',
            'id'
        );
    }
    public function getCommonCount(){
        return count($this->getCommon);
    }
    public function getMaterial()
    {
        return $this->hasManyThrough(
            'App\Models\Material\MaterialOwner',
            'App\Models\User\User',
            'department_id',
            'owner_id',
            'id',
            'id'
        );
    }
    public function getMaterialCount(){
        return count($this->getMaterial);
    }
}
