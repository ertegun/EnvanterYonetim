<?php

namespace App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table="transaction";

    public function getDepartment(){
        return $this->HasOneThrough(
            'App\Models\User\Department',
            'App\Models\User\User',
            'id',
            'id',
            'department_id',
            'user_id'
        );
    }
    public function getType(){
        return $this->HasOne('App\Models\Transaction\TransactionType','id','type_id');
    }
}
