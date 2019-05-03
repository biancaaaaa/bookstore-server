<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = ['orderedAt', 'shop_user_id', 'shipping_address_id', 'totalNet', 'totalPreTax'];

    public function books() : BelongsToMany
    {
        return $this->belongsToMany(Book::class)->withPivot('amount', 'orderPrice');
    }

    public function shippingAddress() : BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function status() : HasMany
    {
        return $this->hasMany(BookStatus::class);
    }

    public function shopUser() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
