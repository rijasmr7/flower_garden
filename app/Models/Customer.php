<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Order;
use App\Models\Inquiry;
use App\Models\MyCart;
use App\Models\Wishlist;
use App\Models\Gardening;


class Customer extends Model
{
    use HasFactory;
    
    protected $table = 'customers';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'address',
        'city',
        'province',
        'district',
        'postal_code',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function gardenings()
    {
        return $this->hasMany(Gardening::class, 'customer_id', 'id');
    }
}
