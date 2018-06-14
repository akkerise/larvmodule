<?php

namespace App\Modules\Cms\Repositories\Role;

use App\Common\Repos\EloquentRepository;
use App\Modules\Cms\Entities\Model\Role;

class RoleRepository
{
    use EloquentRepository;

    protected $_model;

    public function __construct(Role $role)
    {
        $this->_model = $role;
    }

}
