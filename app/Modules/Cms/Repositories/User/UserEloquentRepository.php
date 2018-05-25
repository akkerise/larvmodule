<?php

namespace App\Modules\Cms\Repositories\User;

use App\Modules\Cms\Repositories\EloquentRepository;

class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\User::class;
    }

    /**
     * get all user
     * @return array
     */
    public function all(){
        return $this->_model->all();
    }

    /**
     * get user by id
     * @return collection
     */
    public function find($id){
        return $this->_model->find($id);
    }
}
