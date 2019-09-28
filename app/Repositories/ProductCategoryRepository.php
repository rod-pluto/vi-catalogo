<?php

namespace App\Repositories;

use App\Models\ProductCategory as Category;
use App\Repositories\Interfaces\ProductCategoryRepositoryInterface as CategoryInterface;

class ProductCategoryRepository extends BaseRepository implements CategoryInterface {
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }
}
