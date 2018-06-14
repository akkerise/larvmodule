<?php

namespace App\Modules\Api\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Response;
use Illuminate\Http\Request;
use \Illuminate\Http\Response as Res;
use Illuminate\Routing\Controller;

class ApiController extends Controller{

    private $generalErrors = array(
        0     => 'Lỗi không xác định', 
        101   => 'Phải sử dụng phương thức POST', 
        102   => 'Phải sử dụng phương thức GET', 
        103   => 'Không tồn tại tham số: "{PARAMETER}"',
        104   => 'Tham số: "{PARAMETER}", rỗng',
        105   => 'Sai chữ ký', 
        106   => 'Data Not Found',
        107   => 'Parameter not null',
        108   => 'Authentication failed',
        404   => 'Có lỗi xảy ra'
    );
    
    protected $secretKey = 'Ja20w1eFR0jM3OAqOBrbpaxUunSN7ESE';
    
    public function __construct()
    {
        
    }

    protected $statusCode = Res::HTTP_OK;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
    
    public function checkKeySign(Request $request){
        $params = $request->all();
        if($params == null){
            return $this->respondWithError(107);
        }
        $i = 1;
        $string_sign = '';
        if($params != null && !empty($params)){
            ksort($params);
            foreach ( $params as $key=>$value ) {
                if($key != 'sign'){
                    if($i == 1){
                        $string_sign .= $value;
                    }else{
                        $string_sign .= '|' .$value;
                    }
                    $i++;
                }

            }
        }
        
        $sign = sha1($string_sign.'|'.$this->secretKey);
        if($sign != $params['sign']){
            return $this->respondWithError(105);
        }
    }
    
    public function respondData($message,$errorCode, $data=null){
        $this->setStatusCode(Res::HTTP_OK);
        return $this->respond([
            'error_code' => $errorCode,
            'message' => $message,
            'data' => $data
        ]);

    }
    
    public function respondWithError($error = null, $parameter = null, $value = null){
        if(is_array($parameter)){
            $parameter = explode(', ',$parameter);
        }
        if(is_array($value)){
            $value = explode(', ',$value);
        }
        $error = $this->getError($error, $parameter, $value, null);
        $this->setStatusCode(Res::HTTP_CREATED);
        return $this->respond([
            'status' => 'error',
            'error_code' => $error['id'],
            'message' => $error['message'],
        ]);
    }

    public function respond($data, $headers = []){
        return Response::json($data, $this->getStatusCode(), $headers);
    }
    
    public function getError($error = null, $parameter = null, $value = null){

        if($error == null){
            $error = 0;
        }
        $errorString = $this->generalErrors[$error]; 
       
        if($parameter !== null){
            $errorString = str_replace('{PARAMETER}', $parameter, $errorString);
        }
        
        if($value !== null){
            $errorString = str_replace('{VALUE}', $value, $errorString);
        }
        return array('id'=>$error,'message'=>$errorString);
    }
    
}
