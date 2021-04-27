<?php
namespace App\Models\User;

use App\Models\CommonItem\CommonItemOwner;
use App\Models\Hardware\HardwareOwner;
use App\Models\Material\MaterialOwner;
use App\Models\Software\SoftwareOwner;
use App\Models\Vehicle\VehicleOwner;
use App\Models\Fixture\FixtureOwner;
use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    protected $table="user";
    public function getDepartment()
    {
        return $this->hasOne(Department::class,'id','department_id');
    }

    public function getHardware()
    {
        return $this->hasMany(HardwareOwner::class,'owner_id');
    }
    public function getHardwareCount()
    {
        return $this->getHardware->count();
    }

    public function getSoftware()
    {
        return $this->hasMany(SoftwareOwner::class,'owner_id');
    }
    public function getSoftwareCount()
    {
        return $this->getSoftware->count();
    }

    public function getMaterial()
    {
        return $this->hasMany(MaterialOwner::class,'owner_id');
    }
    public function getMaterialCount()
    {
        return $this->getMaterial->count();
    }

    public function getCommon()
    {
        return $this->hasMany(CommonItemOwner::class,'owner_id');
    }
    public function getCommonCount()
    {
        return $this->getCommon->count();
    }
<<<<<<< Updated upstream
=======

    public function getVehicle()
    {
        return $this->hasMany(VehicleOwner::class,'owner_id');
    }
    public function getVehicleCount()
    {
        return $this->getVehicle->count();
    }

    public function getFixture()
    {
        return $this->hasMany(FixtureOwner::class,'owner_id');
    }
    public function getFixtureCount()
    {
        return $this->getFixture->count();
    }
>>>>>>> Stashed changes
}
