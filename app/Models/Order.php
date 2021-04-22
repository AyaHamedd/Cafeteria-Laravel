<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','room_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'order_product')->withPivot('quantity');
    }

    public function getTotalOrderPrice(){
        $order_products = $this->find($this->id)->products;
        $total_order_price = 0;
        foreach($order_products as $order_product){
            $total_order_price += $order_product->pivot->quantity * $order_product->price;
        }
        return $total_order_price;
    }
}
