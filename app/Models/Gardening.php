<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gardening extends Model
{
    use HasFactory;
    protected $table = 'gardenings';

    protected $fillable = [
        'customer_id',
        'customer_name',
        'phone',
        'address',
        'gardening_date',
    ];

    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
