<?php

namespace App;

use App\OrderDetail;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'category',
        'name',
        'model',
        'size',
        'weight',
        'price',
        'discount',
        'net_price',
        'created_at',
        'updated_at'
    ];

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
