<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'company_id',
        'category_id',
        'image',
        'ean',
        'name',
        'und',
        'price',
        'description',
        'status'
    ];

    public function company() {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function category() {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
