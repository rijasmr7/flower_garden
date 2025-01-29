<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'customer_id',
        'orderable_type',
        'orderable_id',
        'ordered_date',
        'delivery_date',
        'unit_price',
        'quantity',
        'total_amount',
    ];

    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function orderable()
    {
        return $this->morphTo();
    }

    
    protected $casts = [
        'ordered_date' => 'datetime',
        'delivery_date' => 'datetime',
    ];
}
