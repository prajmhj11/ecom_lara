<?php

namespace Laravel\SharedModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    public function products()
    {
        return $this->belongsToMany('Product');
    }
}
