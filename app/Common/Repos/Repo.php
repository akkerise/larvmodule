<?php

/**
 * Created by IntelliJ IDEA.
 * User: akke
 * Date: 5/25/18
 * Time: 1:23 AM
 */

namespace App\Common\Repos;

use Illuminate\Database\Eloquent\Model;

class Repo implements RepoInterface {

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $_model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct(Model $model) {
        $this->_model = $model;
    }

    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all() {
        return $this->_model->all();
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*')) {
        return $this->_model->paginate($perPage, $columns);
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id) {
        $result = $this->_model->find($id);
        return $result;
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes) {
        return $this->_model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update(array $attributes, $id) {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id) {
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            return true;
        }

        return false;
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function by($attribute, $value, $columns = array('*')) {
        return $this->_model->where($attribute, '=', $value)->first($columns);
    }

}
