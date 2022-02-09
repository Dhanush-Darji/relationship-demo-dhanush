<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price'
    ];

    public function getPriceAttribute($value)
    {
        return (float) $value;
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function getQuantityAttribute()
    {
        return (!empty($this->pivot)) ? $this->pivot->quantity : 0;
    }
}
