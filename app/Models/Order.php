<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    public function user()
    {
        // An order holds the foreign key user_id; use belongsTo to reference the User model correctly
        return $this->belongsTo(User::class, 'user_id');
    }
    public function product()
    {
        // An order holds the foreign key product_id; use belongsTo to reference the Product model correctly
        return $this->belongsTo(Product::class, 'product_id');
    }
    // public function products()
    // {
    //     return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')
    //                 ->withPivot('quantity', 'price');
    // }
    // public function getTotalPriceAttribute()
    // {
    //     return $this->products->sum(function ($product) {
    //         return $product->pivot->quantity * $product->pivot->price;
    //     });


}

