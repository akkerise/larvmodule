<?php

namespace App\Modules\Cms\Http\Controllers\User\Services;

use App\Modules\Cms\Http\Controllers\ServiceController;
use App\Modules\Cms\Entities\Service\GameService;
use App\Modules\Cms\Entities\Service\UserService;
use App\Modules\Cms\Entities\Service\RoleService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserController extends ServiceController
{
    protected $user;
    protected $role;

    public function __construct(UserService $user, RoleService $role)
    {
        parent::__construct();
        $this->user = $user;
        $this->role = $role;
    }

    public function detail($userid)
    {
        if (empty($userid)) {
            return $this->response(false, 'User id : ' . $userid . ' not found!', [], ['status' => 404]);
        }
        $user = $this->user->findId($userid);
        if (!empty($user)) {
            return $this->response(true, 'Success', $this->buildDetail($user), ['status' => 201]);
        }
        return $this->response(false, 'Game id : ' . $userid . ' not data!', $user, ['status' => 404]);
    }

    public function list()
    {
        $list = $this->user->listGamesUsers();
        $users = $this->buildListGame($list);
        $temp = (string)view('cms::appui.pages.game.comp.__tbody', [
            'games' => $users
        ]);
        if (!empty($list)) {
            return $this->response(true, 'Success', $temp, ['status' => 201]);
        } else {
            return $this->response(false, 'Data not found!', [], ['status' => 404]);
        }
    }

    private function buildListGame($users)
    {
        $raw = [];
        foreach ($users as $k => $v) {
            $raw[$k] = [
                'gameid' => $v->user_id,
                'name' => $v->name,
                'email' => $v->email,
                'status' => $v->status,
                'logo' => $v->logo
            ];
        }
        return array_slice($raw, 0, 10);
    }

    public function del($id)
    {
        if (empty($id)) {
            return $this->response(false, 'Game id : ' . $id . ' not found!', [], ['status' => 404]);
        }
        $res = $this->user->findOrFail($id);
        if ($this->user->del($res)) {
            return $this->response(true, 'Delete game id : ' . $id . ' success!', $res, ['status' => 200]);
        } else {
            return $this->response(false, 'Delete game id : ' . $id . ' failed!', $res, ['status' => 304]);
        }
    }


    public function getone($userid)
    {
        if (empty($userid)) {
            return $this->response(false, 'Game id : ' . $userid . ' not found!', $this->userCms->find($userid), ['status' => 404]);
        }
        if (!empty($this->userCms->find($userid))) {
            return $this->response(true, 'Success', $this->buildDetail($this->userCms->find($userid)), ['status' => 201]);
        }
        return $this->response(false, 'Game id : ' . $userid . ' not data!', $this->userCms->find($userid), ['status' => 404]);
    }

    private function buildDetail($user)
    {
        return [
            'id' => $user->id,
            'appota_user_id' => $user->appota_user_id,
            'role_name' => $this->getRoleNameById($user->role_id),
            'username' => $user->username,
            'email' => $user->email,
            'fullname' => $user->fullname,
            'birthday' => $user->birthday,
            'mobile' => $user->mobile,
            'address' => $user->address,
            'gender' => $user->gender,
            'is_admin' => $user->is_admin,
            'is_banned' => $user->is_banned,
        ];
    }

    private function getRoleNameById($roleId){
        return $this->role->find($roleId)['name'];
    }
}
