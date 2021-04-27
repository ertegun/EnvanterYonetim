<?php
namespace App\Models\Hardware;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
class HardwareOwner extends Model
{
    protected $table="hardware_owner";
    protected $primaryKey="barcode_number";
    public $incrementing = false;
<<<<<<< Updated upstream
=======
    public $timestamps = false;

>>>>>>> Stashed changes
    public function getOwner()
    {
        return $this->hasOne(User::class,'id','owner_id');
    }

    public function getType()
    {
        return $this->hasOne(HardwareType::class,'id','type_id');
    }

    public function getInfo(){
        return $this->hasOne(Hardware::class,'id','hardware_id');
    }
}
