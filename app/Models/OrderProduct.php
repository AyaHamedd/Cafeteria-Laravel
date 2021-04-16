<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id','product_id','quantity'];

}
