<?php

namespace App\Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Api\Http\Controllers\ApiController;
class TrackController extends ApiController
{
    public function __construct()
    {
        
    }
    
    public function score(Request $request)
    {
        
        if (!$request->isMethod('post')) {
            return $this->respondWithError(101);
        }
        if(!$request->access_token){
            return $this->respondWithError(103,'access_token');
        }
        if(!$request->game_id){
            return $this->respondWithError(103,'game_id');
        }
        if(!$request->score){
            return $this->respondWithError(103,'score');
        }
        if($this->checkKeySign($request)){
            return $this->checkKeySign($request);
        }

        $message = 'success';
        $errorCode = 0;
        return $this->respondData($message,$errorCode);
    }
    
}
