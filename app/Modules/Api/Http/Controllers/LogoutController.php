<?php

namespace App\Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Api\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
use Cookie;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTFactory;
class LogoutController extends ApiController
{
    
    public function __construct()
    {
        
    }
    
    public function logout(Request $request)
    {
        if (!$request->isMethod('post')) {
            return $this->respondWithError(101);
        }
        if(!$request->access_token){
            return $this->respondWithError(103,'access_token');
        }
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
 
            }
            
        }
        $message = 'success';
        $errorCode = 0;
        return $this->respondData($message,$errorCode);
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
