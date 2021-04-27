<?php

namespace App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table="transaction";

    public function getDepartment(){
        return $this->HasOneThrough(
            Department::class,
            User::class,
            'id',
            'id',
            'department_id',
            'user_id'
        );
    }
    public function getType(){
        return $this->HasOne(TransactionType::class,'id','type_id');
    }
}
