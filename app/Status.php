<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Status extends Model
{
    protected $table = 'status';
    protected $fillable = ['description'];

    public function bookStatus() : HasOne
    {
        $this->hasOne(BookStatus::class);
    }
}
