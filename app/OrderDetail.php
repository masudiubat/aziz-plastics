<?php

namespace App;

use App\Order;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',
        'total',
        'created_at',
        'updated_at'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
