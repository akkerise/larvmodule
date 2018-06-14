<?php

namespace App\Modules\Client\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\User;
use App\Common\Repos\Repo;
use App\Modules\Client\Repositories\User\UserRepositoryInterface;
use App\Modules\Client\Http\Controllers\ClientController;
use App\Common\Gamota\RequestApi;
class HomeController extends ClientController
{
    
    public function __construct()
    {
        
    }

    public function index(){
       
        return view('client::home.index', [
            'games' => ''
        ]);
    }
    
}
