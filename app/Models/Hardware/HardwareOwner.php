<?php
namespace App\Models\Hardware;
use Illuminate\Database\Eloquent\Model;
class HardwareOwner extends Model
{
    protected $table="hardware_owner";
    protected $primaryKey="barcode_number";
    public $incrementing = false;
    public $timestamps = false;
    public function getOwner()
    {
        return $this->hasOneThrough(
            'App\Models\User\User',
            'App\Models\User\Owner',
            'bn',
            'id',
            'bn',
            'id'
        );
    }
    public function getType()
    {
        return $this->hasOne('App\Models\Hardware\HardwareType','id','type_id');
    }
    public function getInfo(){
        return $this->hasOne('App\Models\Hardware\Hardware','id','hardware_id');
    }
}
