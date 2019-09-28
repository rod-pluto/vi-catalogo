<?php 

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface as BaseInterface;

class BaseRepository implements BaseInterface {
    protected $model;

    public function findAll($paginate=null) {
        return $paginate ? $this->model->paginate($paginate) : $this->model->all();
    }

    public function find( int $id ) {
        return $this->model->findOrFail( $id );
    }

    public function create( array $data ) {
        $entity = null;
        $entity = $this->model->create( $data );
        return $entity;
    }

    public function update( int $id, array $data ) {
        $entity = $this->model->findOrFail( $id );
        $entity->fill( $data );
        $entity->save();
        return $entity;
    }

    public function delete( int $id ):bool {
        $entity = $this->model->findOrFail( $id );
        if ( $entity->delete() ) {
            return true;
        }
        return false;
    }
}