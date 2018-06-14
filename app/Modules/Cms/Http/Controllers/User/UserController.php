<?php

namespace App\Modules\Cms\Http\Controllers\User;

use App\Modules\Cms\Http\Requests\User\CmsAddUserRequest;
use App\Modules\Cms\Entities\Service\UserService;
use App\Modules\Cms\Entities\Service\RoleService;
use App\Common\Entities\Api\AppotaUploadImageApi;
use App\Common\Untils\Regular;
use App\Common\Untils\Message as Msg;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;
    protected $role;

    public function __construct(UserService $user, RoleService $role)
    {
        $this->middleware('cms');
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
        return view('cms::appui.pages.user.list', ['users' => $this->user->list()]);
    }

    public function addUser()
    {
        return view('cms::appui.pages.user.add', ['roles' => $this->role->list()]);
    }

    public function add(CmsAddUserRequest $request)
    {
        $validator = validator()->make($request->all(), $request->rules(), $request->messages());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if (!$this->user->store($this->buildDataAddInsertDB($request))) {
                return redirect()->route('cms.user.list')->with(Msg::buildMsgAction('danger', "You can't create new user!"));
            }
            return redirect()->route('cms.user.list')->with(Msg::buildMsgAction('success', 'You are created new user successful!'));
        }
    }

    public function editUser(){
        return view('cms::appui.pages.user.edit', ['roles' => $this->role->list(), 'user' => $this->role->list()]);
    }

    private function buildDataAddInsertDB($request)
    {
        $avatar = $request->file('avatar');
        $resAvatar = AppotaUploadImageApi::resp($avatar->getRealPath());
        return [
            'appota_user_id' => 0,
            'role_id' => $request->role_id,
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthday' => $request->birthday,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'avatar' => $resAvatar->data->url,
            'gender' => $request->gender,
            'status' => $request->status,
            'refresh_token' => Hash::make($resAvatar->data->url),
            'remember_token' => bcrypt($resAvatar->data->url),
            'expired_at' => bcrypt(time("Y-m-d H:i:s"))
        ];
    }
}
