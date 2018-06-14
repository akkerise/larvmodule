<?php

namespace App\Modules\Cms\Repositories\Cate;

use App\Common\Repos\EloquentRepository;
use App\Modules\Cms\Entities\Model\Categories;

class CategoryRepository
{
    use EloquentRepository;

    protected $_model;


    public function __construct(Categories $cate)
    {
        $this->_model = $cate;
    }

    public function findBy(array $condition = [])
    {
        return $this->_model->where($condition)->get();
    }
}
