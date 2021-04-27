<?php
namespace App\Models\Hardware;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
class Hardware extends Model
{
    protected $table="hardware";
    protected $primaryKey="barcode_number";
    public $incrementing = false;

    public function getOwner()
    {
        return $this->hasOneThrough(
            User::class,
            HardwareOwner::class,
            'hardware_id',
            'id',
            'id',
            'owner_id'
        );
    }

    public function getType()
    {
        return $this->hasOne(HardwareType::class,'id','type_id');
    }

    public function getModel(){
        return $this->hasOne(HardwareModel::class,'id','model_id');
    }
}
