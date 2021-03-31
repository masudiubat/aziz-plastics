<?php

namespace App;

use App\Order;
use App\Designation;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'designation_id', 'user_id', 'parent_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function parent()
    {
        return $this->belongsTo('User', 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany('User', 'parent_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function sr_purchases()
    {
        return $this->hasMany(Purchase::class, 'sr_id');
    }

    public function dsm_purchases()
    {
        return $this->hasMany(Purchase::class, 'dsm_id');
    }

    public function sdsm_purchases()
    {
        return $this->hasMany(Purchase::class, 'sdsm_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
