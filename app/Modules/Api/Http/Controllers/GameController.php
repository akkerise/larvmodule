<?php

namespace App\Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Api\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
use \App\Modules\Api\Models\Game;
class GameController extends ApiController
{
    private $_modelName;
    public function __construct()
    {
        $this->_modelName = new Game();
    }
    
    public function games(Request $request)
    {
        $offset = 0;
        $limit = 10;
        $categoryId = null;
        if($this->checkKeySign($request)){
            return $this->checkKeySign($request);
        }
        if (!$request->isMethod('get')) {
            return $this->respondWithError(102);
        }
        if($request->offset){
           $offset = $request->offset; 
        }
        if($request->limit){
           $limit = $request->limit; 
        }
        if($request->category_id){
            $categoryId = $request->category_id;
        }
        $data = $this->_modelName->getList($offset,$limit,$categoryId);
    
        $message = 'success';
        $errorCode = 0;
        return $this->respondData($message,$errorCode,$data);
    }
    
}
