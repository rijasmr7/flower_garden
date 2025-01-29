<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    
    protected $table = 'inquiries';

    
    protected $fillable = [
        'customer_id',
        'name',
        'phone',
        'address',
        'message',
        'replies'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
