<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory;
    use SearchableTrait, Searchable;

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'products.name' => 10,
            'products.details' => 5,
            'products.description' => 2,
        ]
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function presentPrice()
    {
        return '$'. number_format($this->price/100, 2);
    }

    public function scopeMightAlsoLike($query)
    {
        return $query->inRandomOrder()->take(6);
    }
}
