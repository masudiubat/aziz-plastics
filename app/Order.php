<?php

namespace App;

use App\User;
use App\Dealer;
use App\OrderDetail;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'sr_id',
        'dealer_id',
        'order_number',
        'remark',
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

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
