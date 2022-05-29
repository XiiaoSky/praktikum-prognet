<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'transaction_id',
        'product_id',
        'qty',
        'discount',
        'selling_price',
       
    ];

    public function product()
    {

    }
}
