<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'customer_name',
        'contact_phone',
    ];

    public function bakeryOrders()
    {
        return $this->hasMany(BakeryOrder::class, 'customer_id', 'customer_id');
    }
}