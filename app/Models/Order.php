<?php

namespace App\Models;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, BaseModel;

    protected $fillable = [
        'sub_total',
        'total',
        'is_paid',
    ];

    public $queryable = [
        'id',
        'created_at'
    ];

    public $scopedFilter = [
        'created_at'
    ];

    public $sortable= [
        'id',
        'sub_total',
        'total',
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

    protected $relationship = [
        'products' => [
            'model' => 'App\\Models\\Product',
        ],
    ];

}
