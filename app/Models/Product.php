<?php

namespace App\Models;

use App\Traits\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, BaseModel;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price'
    ];

    public $queryable = [
        'id'
    ];

    public $sortable= [
        'id',
        'name',
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

    protected $relationship = [
        'orders' => [
            'model' => 'App\\Models\\Order',
        ],
    ];

    public function scopeStartsBefore(Builder $query, $date): Builder
    {
        return $query->where('created_at', '<=', Carbon::parse($date));
    }

    public function scopeStartsBetween(Builder $query, $startDate, $endDate): Builder
    {
        return $query->whereBetween('created_at', [Carbon::parse($startDate), Carbon::parse($endDate)]);
    }

    public function scopePriceLowerThan(Builder $query, $data)
    {
        return $query->where('price', '<=', $data);
    }

    public function scopePriceBetween(Builder $query, $startingPrice, $endingPrice): Builder
    {
        return $query->whereBetween('price', [$startingPrice , $endingPrice]);
    }

    public function scopePriceGreaterThan(Builder $query, $data)
    {
        return $query->where('price', '>=', $data);
    }

    protected $exactFilters = [
        'name'
    ];

    protected $scopedFilters = [
        'starts_before',
        'starts_between',
        'price_lower_than',
        'price_between',
        'price_greater_than'
    ];
}
