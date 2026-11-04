<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CakeProduct extends Model
{
    use HasFactory;

    protected $table = 'cake_products';
    protected $primaryKey = 'cake_product_id';

    protected $fillable = [
        'cake_flavor',
        'cake_size',
        'base_price',
    ];

    public function bakeryOrders()
    {
        return $this->hasMany(BakeryOrder::class, 'cake_product_id', 'cake_product_id');
    }
}