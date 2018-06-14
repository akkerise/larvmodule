<?php
namespace App\Modules\Common\Repositories\User;

interface UserRepositoryInterface
{
    /**
     * Get all posts only published
     * @return mixed
     */
    public function all();

    /**
     * Get post only published
     * @return mixed
     */
    public function find($id);
}
