<?php

namespace App\Modules\Cms\Repositories\User;

use App\Common\Repos\EloquentRepository;
use App\Modules\Cms\Entities\Model\User;

class UserRepository
{
    use EloquentRepository;

    protected $_model;

    public function __construct(User $user)
    {
        $this->_model = $user;
    }

}
