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
use Illuminate\Support\Facades\DB;
class PlaygameController extends ClientController
{
    
    public function __construct()
    {
        
    }

    public function index(Request $request){
        if(!$request->slug){
            die('khong tim thay game');
        }
        $data = $this->getDetailGame($request->slug);
        
        return view('client::playgame.index', [
            'data' => $data
        ]);
    }
    
    public function getDetailGame($slug = null){
        $data = DB::table('h5_games')->where('slug',$slug)->first();
        return (array) $data;
    }
    
    
    
}
