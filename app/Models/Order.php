<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orderdetails() {
        return $this->hasMany(Orderdetail::class, 'order_id', 'id');
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    
}
