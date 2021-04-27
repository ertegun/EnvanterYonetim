<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table="admin";
<<<<<<< Updated upstream
=======
    public function getRole()
    {
        return $this->hasOne(Role::class,'id','role_id');
    }
>>>>>>> Stashed changes
}
