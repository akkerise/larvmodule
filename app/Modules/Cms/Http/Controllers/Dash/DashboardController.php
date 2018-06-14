<?php
namespace App\Modules\Cms\Http\Controllers\Dash;

use App\Modules\Cms\Entities\Service\UserService;
use App\Modules\Cms\Entities\Model\User;
use App\Common\Untils\Regular;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $users;

    public function __construct(UserService $users)
    {
    	$this->middleware('cms');
        $this->users = $users;
    }

    public function index(){
        return view('cms::appui.pages.dash.dash');
    }
}
