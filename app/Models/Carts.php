<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;
    protected $fillable = [
        'clients',
        'product_id',
        'comment',
        'quantity',
        'total_cost',
        'status',
    ];

    public function scopeNew($query)
    {
        return $query->where('status', 'Новый');
    }
    
}
