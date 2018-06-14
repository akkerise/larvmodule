<?php

namespace App\Modules\Cms\Entities\Service;

use App\Modules\Cms\Repositories\Role\RoleRepository;

class RoleService {

    protected $role;

    public function __construct (RoleRepository $role){
        $this->role = $role;
    }

    public function list(){
        return $this->role->get();
    }

    public function find($roleId){
        return $this->role->findOrFail($roleId);
    }
}
