<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pot extends Model
{
    use HasFactory;
    protected $table = 'pots';
    protected $fillable = ['name', 'price', 'size', 'description', 'category', 'is_available', 'quantity', 'pot_color', 'purchased_date', 'image'];

    public function orders()
    {
        return $this->morphMany(Order::class, 'orderable');
    }

    public function carts()
    {
        return $this->morphMany(MyCart::class, 'cartable');
    }
}
