<?php

namespace App\Modules\Cms\Entities\Service;

use App\Modules\Cms\Entities\Model\Categories;
use App\Modules\Cms\Repositories\Cate\CategoryRepository;


class CategoryService {

    protected $cate;

    public function __construct (CategoryRepository $cate){
        $this->cate = $cate;
    }

    public function list(){
        return $this->cate->get();
    }

    public function store(array $input){
        try {
            \DB::beginTransaction();
            $result = $this->cate->store($input);
            \DB::commit();
        } catch (\Exception $e) {
            logger()->error(sprintf('create category fails. data: %s, exception: %s', json_encode($input), $e->getMessage()));
            \DB::rollBack();
            $result = false;
        }
        logger()->debug('#', ['result' => (bool)$result]);
        return $result;
    }

    public function update(Categories $cate, array $input)
    {
        try {
            \DB::beginTransaction();
            $result = $this->cate->update($cate, $input);
            \DB::commit();
        } catch (\Exception $e) {
            logger()->error(sprintf('update category fails. id: %d, data: %s, exception: %s', $cate->id, json_encode($input), $e->getMessage()));
            \DB::rollBack();
            $result = false;
        }
        logger()->debug('#', ['result' => (bool)$result, 'id' => $cate->id]);
        return $result;
    }

    public function findId($cateid){
        return $this->cate->findOrFail($cateid);
    }

    public function findByCondition(array $condition = []){
        return $this->cate->findBy($condition);
    }
}
