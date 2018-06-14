<?php
/**
 * Created by IntelliJ IDEA.
 * User: akke
 * Date: 5/29/18
 * Time: 3:15 PM
 */

namespace App\Modules\Cms\Http\Controllers\Auth;

use App\Modules\Cms\Http\Requests\Auth\CmsLoginRequest;
use App\Modules\Cms\Entities\Model\User;
use App\Common\Untils\Regular;
use App\Common\Repos\Repo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->user = new Repo($user);
    }

    public function gLogin()
    {
        if (auth()->guard(Regular::PREFIX_CMS)->check()) {
            return redirect('cms/dash');
        } else {
            return view('cms::appui.pages.auth.login');
        }
    }

    public function pLogin(CmsLoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (auth()->guard(Regular::PREFIX_CMS)->attempt($login, $request->has('remember'))) {
            return redirect()->intended('cms/dash');
        }else{
            if((Hash::check($request->password, $this->user->by('email', $request->email, ['password'])->password) == false) || empty($this->user->by('email', $request->email, ['email']))){
                return redirect()->route('cms.g.login');
            }
        }
    }

    public function gLogout(Request $request)
    {
        auth()->guard(Regular::PREFIX_CMS)->logout();
        session()->flush();
        return redirect('cms/login');
    }

}
