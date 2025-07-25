<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name'];
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
