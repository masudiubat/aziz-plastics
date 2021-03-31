<?php

namespace App;

use App\Dealer;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'dealer_id',
        'total_deposit',
        'total_purchase',
        'balance',
        'created_at',
        'updated_at'
    ];
}
