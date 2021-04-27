<?php
namespace App\Models\Fixture;
use Illuminate\Database\Eloquent\Model;
class FixtureType extends Model
{
    protected $table="fixture_type";
    public function getUsingItems()
    {
        return $this->hasManyThrough(
            FixtureOwner::class,
            Fixture::class,
            'type_id',
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
        return $this->hasMany(Fixture::class,'type_id','id');
    }
    public function getItemsCount()
    {
        return count($this->getItems);
    }
    public function getUseableItemsCount(){
        return ($this->getItemsCount()-$this->getUsingItemsCount());
    }
}
