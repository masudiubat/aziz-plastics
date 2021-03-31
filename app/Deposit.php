<?php

namespace App;

use App\Dealer;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'dealer_id',
        'amount',
        'image',
        'deposit_date',
        'status',
        'created_at',
        'updated_at'
    ];

    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }
}
