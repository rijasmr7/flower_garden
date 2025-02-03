<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Order;
use App\Models\MyCart;

class Plant extends Model
{
    use HasFactory;
    protected $table = 'plants';
    protected $fillable = ['name', 'price', 'size', 'description', 'category', 'is_available', 'quantity', 'leave_color', 'purchased_date','image'];

    public function orders()
{
    return $this->morphMany(Order::class, 'orderable');
}

public function carts()
{
    return $this->morphMany(MyCart::class, 'cartable');
}
}

