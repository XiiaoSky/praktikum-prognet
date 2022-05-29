<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

  

    protected $fillable = [
        'address',
        'regency',
        'province',
        'total',
        'shipping_cost',
        'sub_total',
        'courier',
        'proof_of_payment',
        'status',
        'timeout',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetails::class);
    }

}
