<?php
namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
class Section extends Model
{
    protected $table="section";
    public function getDepartment()
    {
        return $this->hasOne(Department::class,'id','department_id');
    }
    /*public function getUserCount()
    {
        return count($this->getUser);
    }

    public function getHardware()
    {
        return $this->hasManyThrough(
            HardwareOwner::class,
            User::class,
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
            SoftwareOwner::class,
            User::class,
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
            CommonItemOwner::class,
            User::class,
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
            MaterialOwner::class,
            User::class,
            'department_id',
            'owner_id',
            'id',
            'id'
        );
    }
    public function getMaterialCount(){
        return count($this->getMaterial);
    }

    public function getVehicle()
    {
        return $this->hasManyThrough(
            VehicleOwner::class,
            User::class,
            'department_id',
            'owner_id',
            'id',
            'id'
        );
    }
    public function getVehicleCount(){
        return count($this->getVehicle);
    }

    public function getFixture()
    {
        return $this->hasManyThrough(
            FixtureOwner::class,
            User::class,
            'department_id',
            'owner_id',
            'id',
            'id'
        );
    }
    public function getFixtureCount(){
        return count($this->getFixture);
    }*/
}
