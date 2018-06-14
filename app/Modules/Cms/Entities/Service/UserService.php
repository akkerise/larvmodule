<?php

namespace App\Modules\Cms\Entities\Service;

use App\Modules\Cms\Repositories\User\UserRepository;

class UserService {

    protected $user;

    public function __construct (UserRepository $user){
        $this->user = $user;
    }

    public function list(){
        return $this->user->get();
    }

    public function store(array $input){
        try {
            \DB::beginTransaction();
            $result = $this->user->store($input);
            \DB::commit();
        } catch (\Exception $e) {
            logger()->error(sprintf('create game fails. data: %s, exception: %s', json_encode($input), $e->getMessage()));
            \DB::rollBack();
            $result = false;
        }
        logger()->debug('#', ['result' => (bool)$result]);
        return $result;
    }

    public function findId($id){
        return $this->user->findOrFail($id);
    }

}
