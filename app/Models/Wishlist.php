<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $table = 'wishlists';
    protected $fillable = [
        'customer_id',
        'customer_name',
        'phone',
        'product_name',
        'product_specification',
        'image',
    ];

    
    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id', 'id');
    }
}
