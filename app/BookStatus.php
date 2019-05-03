<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookStatus extends Model
{
    protected $table = 'order_status';
    protected $fillable = ['order_id', 'status_id', 'comment', 'changedAt'];

    public function status() : BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
