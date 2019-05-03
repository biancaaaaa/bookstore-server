<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Address extends Model
{
    protected $fillable = ['address1', 'address2', 'postal_code', 'city', 'country'];

    public function user() : HasOne
    {
        return $this->hasOne(User::class);
    }

    public function order() : HasOne
    {
        return $this->hasOne(Order::class);
    }
}
