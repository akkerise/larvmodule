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
use Cookie;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTFactory;

class LogoutController extends ClientController
{
    
    public function __construct()
    {
        
    }

    public function index(Request $request){
        if($request->access_token){
            $userInfo = $this->getUserInfoByAccessToken($request->access_token);
            if(!empty($userInfo)){
                $factory = JWTFactory::addClaims([
                    'wallet_user_id' => $userInfo['appota_user_id'],
                    'sub'   => env('API_ID'),
                    'iss'   => config('app.name'),
                    'iat'   => time(),
                    'exp'   => JWTFactory::getTTL(),
                    'nbf'   => time(),
                    'jti'   => uniqid(),
                ]);
                $payload = $factory->make();
                $token = JWTAuth::encode($payload);

                $paramUpdateUser = [
                    'access_token' => $token
                ];
                $this->updateAccessToken($paramUpdateUser,$userInfo['appota_user_id']);

                Cookie::queue(Cookie::forget('access_token'));
                Cookie::queue(Cookie::forget('user_id'));
                Cookie::queue(Cookie::forget('fullname'));
                Cookie::queue(Cookie::forget('phone_number'));
                
            }
            
        }
        return redirect('/');
    }
    
    private function getUserInfoByAccessToken($accessToken){
        $data = DB::table('h5_users')->where('access_token',$accessToken)->first();
        return (array) $data;
    }
    
    private function updateAccessToken($params,$userId){
        DB::table('h5_users')
            ->where('appota_user_id', $userId)
            ->update($params);
    }
    
}
