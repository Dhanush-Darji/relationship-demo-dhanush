<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_total',
        'total',
        'is_paid',
    ];

    public $queryable = [
        'id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function getQuantityAttribute()
    {
        return (!empty($this->products)) ? $this->products->sum('pivot.quantity') : 0;
    }

}
