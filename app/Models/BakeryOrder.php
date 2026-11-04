<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BakeryOrder extends Model
{
    use HasFactory;

    protected $table = 'bakery_orders';
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'customer_id',
        'cake_product_id',
        'pickup_datetime',
        'order_status',
    ];

    protected $casts = [
        'pickup_datetime' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function cakeProduct()
    {
        return $this->belongsTo(CakeProduct::class, 'cake_product_id', 'cake_product_id');
    }

    public function customization()
    {
        return $this->hasOne(Customization::class, 'order_id', 'order_id');
    }

    public function payment()
    {
        return $this->hasOne(OrderPayment::class, 'order_id', 'order_id');
    }
}