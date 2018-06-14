<?php

namespace App\Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Api\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
use \App\Modules\Api\Models\Category;
use App\Common\Gamota\RequestApi;
class LoginController extends ApiController
{
    private $endPointInfo = 'https://login.appota.com/api/v1/users/info?access_token=%s';
    
    public function __construct()
    {
        
    }
    
    public function wallet(Request $request)
    {
        if (!$request->isMethod('post')) {
            return $this->respondWithError(101);
        }
        if(!$request->wallet_access_token){
            return $this->respondWithError(103,'wallet_access_token');
        }
        $url = sprintf($this->endPointInfo,$request->wallet_access_token);
        $respone = RequestApi::create($url,null,'GET');
        $data = json_decode($respone,true);
        if(empty($data) || isset($data['code'])){
            return $this->respondWithError(108);
        }
        
        if($this->isExistsUser($data['user_id'])){
            return $this->responseDataUser($data['user_id']);
        }else{
            //register
            $paramsUser = [
                'appota_user_id' => $data['user_id'],
                'role_id' => 10,
                'username' => '',
                'password' => '',
                'email' => '',
                'fullname' => $data['fullname'],
                'birthday' => '',
                'mobile' => $data['phone_number'],
                'address' => '',
                'avatar' => '',
                'gender' => 1,
                'register_date' => time(),
                'register_ip' => '192.168.12.1',
                'last_activity' => time(),
                'is_moderator' => 0,
                'is_admin' => 0,
                'is_banned' => 0,
                'status' => 1,
                'access_token' => '',
                'refresh_token' => '',
                'remember_token' => '',
                'expired_at' => '',
                'created_at' => time(),
                'updated_at' => time(),
                ];
            
            $this->registerUser($paramsUser);
            
            if($this->isExistsUser($data['user_id'])){
                $this->createAccessTokenH5($data);
                return $this->responseDataUser($data['user_id']);
            }
        }
        
    }
    
    private function responseDataUser($userId){
        $data = $this->getUserInfoByUserId($userId);
        $message = 'success';
        $errorCode = 0;
        return $this->respondData($message,$errorCode,$data);
    }
    
    private function createAccessTokenH5($data){
        $factory = JWTFactory::addClaims([
            'wallet_user_id' => $data['user_id'],
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
        $this->updateUser($paramUpdateUser,$data['user_id']);
        
    }
    
    private function getUserInfoByUserId($userId){
        $data = DB::table('h5_users')->where('appota_user_id',$userId)
                ->first([
                    'access_token',
                    'id as user_id',
                    'appota_user_id as wallet_user_id',
                    'username',
                    'email',
                    'fullname',
                    'mobile as phone_number',
                    ]);
                
        return (array) $data;
    }
    private function isExistsUser($userId){
        $data = DB::table('h5_users')->where('appota_user_id',$userId)->first();
        if(!empty($data)){
            return true;
        }
        return false;
    }
    
    private function registerUser($params){
        DB::table('h5_users')->insert(
           $params
        );
    }
    
    private function updateUser($params,$userId){
        DB::table('h5_users')
            ->where('appota_user_id', $userId)
            ->update($params);
    }
    
}
