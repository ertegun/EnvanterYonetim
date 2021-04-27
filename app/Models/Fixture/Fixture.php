<?php
namespace App\Models\Fixture;

use App\Models\Properties\Bill;
use App\Models\Properties\Supplier;
use App\Models\User\Department;
use App\Models\User\Section;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
class Fixture extends Model
{
    protected $table="fixture";

    public function getOwner()
    {
        return $this->hasOneThrough(
            User::class,
            FixtureOwner::class,
            'fixture_id',
            'id',
            'id',
            'owner_id'
        );
    }

    public function getDepartment(){
        return $this->hasOne(Department::class,'id','department_id');
    }

    public function getSection(){
        return $this->hasOne(Section::class,'id','section_id');
    }

    public function getType()
    {
        return $this->hasOne(FixtureType::class,'id','type_id');
    }

    public function getBrand(){
        return $this->hasOne(FixtureBrand::class,'id','brand_id');
    }

    public function getSupplier(){
        return $this->hasOne(Supplier::class,'id','supplier_id');
    }

    public function getBill(){
        return $this->hasOne(Bill::class,'id','bill_id');
    }
}
