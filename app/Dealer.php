<?php

namespace App;

use App\User;
use App\Order;
use App\Deposit;
use App\Purchase;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'sr_id',
        'dsm_id',
        'sdsm_id',
        'company_name',
        'dealer_name',
        'dealer_code',
        'address',
        'mobile',
        'created_at',
        'updated_at'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
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
}
