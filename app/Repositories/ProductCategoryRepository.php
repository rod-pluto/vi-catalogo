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

    public function delete( int $id ):bool {
        $entity = $this->model->findOrFail( $id );

        if ( count( $entity->products ) > 0 ){
            throw new \Exception('Categoria possui produtos associados');
        } else {
            if ( $entity->delete() ) {
                return true;
            }
        }

        return false;
    }
}
