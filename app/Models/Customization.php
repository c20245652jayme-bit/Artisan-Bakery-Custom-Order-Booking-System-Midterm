<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customization extends Model
{
    use HasFactory;

    protected $table = 'customizations';
    protected $primaryKey = 'customization_id';

    protected $fillable = [
        'order_id',
        'custom_inscription',
        'add_on_decorations',
        'add_on_price',
    ];

    protected $casts = [
        'add_on_price' => 'decimal:2',
    ];

    public function bakeryOrder()
    {
        return $this->belongsTo(BakeryOrder::class, 'order_id', 'order_id');
    }
}