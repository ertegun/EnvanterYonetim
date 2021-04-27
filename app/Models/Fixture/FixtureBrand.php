<?php
namespace App\Models\Fixture;

use App\Models\Fixture\FixtureOwner;
use Illuminate\Database\Eloquent\Model;
class FixtureBrand extends Model
{
    protected $table="fixture_brand";
    public function getUsingItems()
    {
        return $this->hasManyThrough(
            FixtureOwner::class,
            Fixture::class,
            'brand_id',
            'fixture_id',
            'id',
            'id',
        );
    }
    public function getUsingItemsCount()
    {
        return count($this->getUsingItems);
    }
    public function getItems(){
        return $this->hasMany(Fixture::class,'brand_id','id');
    }
    public function getItemsCount()
    {
        return count($this->getItems);
    }
    public function getUseableItemsCount(){
        return ($this->getItemsCount()-$this->getUsingItemsCount());
    }
}
