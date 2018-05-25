<?php
namespace App\Modules\Cms\Repositories\User;

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
