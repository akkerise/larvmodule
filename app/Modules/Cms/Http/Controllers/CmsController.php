<?php

namespace App\Modules\Cms\Http\Controllers;

use App\Modules\Cms\Entities\Model\User;
use App\Common\Repos\Repo;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CmsController extends Controller
{

	public function __construct()
	{
		// $this->middleware('cms');
	}

	public function index()
	{
		if(auth()->guard(Regular::PREFIX_CMS)->check()){
			return redirect('cms/dash');
		}else{
			return redirect('cms/login');
		}
	}

}
