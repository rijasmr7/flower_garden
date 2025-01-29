<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyCart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'customer_id',
        'cartable_type',
        'cartable_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

   public function cartable()
   {
     return $this->morphTo();
   }
}
