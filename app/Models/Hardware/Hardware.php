<?php
namespace App\Models\Hardware;
use Illuminate\Database\Eloquent\Model;
class Hardware extends Model
{
    protected $table="hardware";
    protected $primaryKey="barcode_number";
    public $incrementing = false;
    public function getOwner()
    {
        return $this->hasOneThrough(
            'App\Models\User\User',
            'App\Models\Hardware\HardwareOwner',
            'hardware_id',
            'id',
            'id',
            'owner_id'
        );
    }
    public function getType()
    {
        return $this->hasOne('App\Models\Hardware\HardwareType','id','type_id');
    }
    public function getModel(){
        return $this->hasOne('App\Models\Hardware\HardwareModel','id','model_id');
    }
}
