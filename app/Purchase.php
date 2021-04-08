<?php

namespace App;

use App\Order;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'sdsm_id',
        'dsm_id',
        'sr_id',
        'dealer_id',
        'order_id',
        'total_amount',
        'discount',
        'net_amount',
        'paid_amount',
        'status',
        'created_at',
        'updated_at'
    ];

    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }

    public function sr()
    {
        return $this->belongsTo(User::class, 'sr_id', 'id');
    }

    public function dsm()
    {
        return $this->belongsTo(User::class, 'dsm_id', 'id');
    }

    public function sdsm()
    {
        return $this->belongsTo(User::class, 'sdsm_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
