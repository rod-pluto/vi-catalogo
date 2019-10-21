<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'image',
        'ean',
        'name',
        'und',
        'price',
        'description',
        'status'
    ];

    public function category() {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function getCod() {
        return trim(explode('-', $this->name)[0]);
    }
}
