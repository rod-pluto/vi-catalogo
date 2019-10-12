<?php

namespace App\Repositories;

use App\Models\Product as Product;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductInterface;

class ProductRepository extends BaseRepository implements ProductInterface {
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function delete( int $id ):bool {
        $entity = $this->model->findOrFail( $id );

        if ($entity->items) {
            return false;
        }

        if ( $entity->delete() ) {
            return true;
        }

        return false;
    }
}
