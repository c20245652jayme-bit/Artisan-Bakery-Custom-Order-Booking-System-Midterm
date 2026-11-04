<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $table = 'order_payments';
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'order_id',
        'payment_amount',
        'payment_date',
        'payment_method',
        'total_deposit',
        'balance_due',
    ];

    protected $casts = [
        'payment_amount' => 'decimal:2',
        'total_deposit' => 'decimal:2',
        'balance_due' => 'decimal:2',
        'payment_date' => 'date',
    ];

    public function bakeryOrder()
    {
        return $this->belongsTo(BakeryOrder::class, 'order_id', 'order_id');
    }
}