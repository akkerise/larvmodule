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
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTFactory;
use Cookie;
use Session;

class LoginController extends ClientController
{
    private $client = '973260286001234';
    private $secret = 'OEYoSpW2DNPXpaW1';
    private $redirect_uri = 'http://h5.gamota.test:8000/login/verify';
    private $endPointVerify = 'https://login.appota.com/app/oauth/access_token';
    private $endPointInfo = 'https://login.appota.com/api/v1/users/info?access_token=%s';
    private $message = 'Có lỗi xảy ra vui lòng thử lại';
    public function __construct()
    {
        
    }

    public function wallet(Request $request){
        if(!$request->code){
            return redirect('/')->with('message', $this->message);
        }
        $code = $request->code;
        if($this->verify($code)){
            return redirect('/')->with('message', $this->message);
        }else{
            return redirect('/')->with('message', $this->message);
        }
        return view('client::home.index', [
            'games' => ''
        ]);
    }
    
    private function verify($code){
        $url = $this->endPointVerify;
        $api_params  = array(
            'client_id' => $this->client,
            'client_secret' => $this->secret,
            'request_token'	=> $code,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->redirect_uri
        );
        $respone = RequestApi::create($url,$api_params,'POST');
        $data = json_decode($respone,true);
        
        if(empty($data) || isset($data['code'])){
            return false;
        }
        if(!empty($data) && isset($data['access_token'])){
            $access_token  = $data['access_token'];
            if(!$this->getUserInfoWallet($access_token)){
                return false;
            }
        }
        return true;
 
    }
    
    private function getUserInfoWallet($access_token){
        $url = sprintf($this->endPointInfo,$access_token);
        $respone = RequestApi::create($url,null,'GET');
        $data = json_decode($respone,true);
        //var_dump($access_token);die;
        if(empty($data)){
            return false;
        }
        if(!$this->loginH5($data)){
            return false;
        }
        return true;
    }
    
    private function loginH5($data){
        if($this->isExistsUser($data['user_id'])){
            $this->saveCookie($data);
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
                $this->saveCookie($data);
            }
        }
        return true;
    }
    
    private function saveCookie($data){
        $userInfo = $this->getUserInfoByUserId($data['user_id']);
        if(!empty($userInfo)){
            Cookie::queue('access_token', $userInfo['access_token']);
            Cookie::queue('user_id', $userInfo['id']);
            Cookie::queue('fullname', $userInfo['fullname']);
            Cookie::queue('phone_number', $userInfo['mobile']);
        }
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
        $data = DB::table('h5_users')->where('appota_user_id',$userId)->first();
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
    
    private function JWTDecode($token){
        try {
            $apy = JWTAuth::getPayload($token)->toArray();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 500);
        }
    }
    
}
