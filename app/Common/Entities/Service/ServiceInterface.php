<?php

namespace App\Common\Entities\Service;

interface ServiceInterface {

    public function getById($id);

    public function searchList($condition);

    public function create($data);

    public function edit($data);

    public function del($id);

    public static function mappingData($data, $roles);
}
