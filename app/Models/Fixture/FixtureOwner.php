<?php
namespace App\Models\Fixture;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
class FixtureOwner extends Model
{
    protected $table="fixture_owner";

    public function getOwner()
    {
        return $this->hasOne(User::class,'id','owner_id');
    }

    public function getType()
    {
        return $this->hasOne(FixtureType::class,'id','type_id');
    }

    public function getInfo(){
        return $this->hasOne(Fixture::class,'id','fixture_id');
    }
}
