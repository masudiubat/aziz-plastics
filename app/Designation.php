<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'short_name',
        'order_id',
        'created_at',
        'updated_at'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
