<?php

namespace App\Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Api\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
use \App\Modules\Api\Models\Category;
class CategoryController extends ApiController
{
    private $_modelName;
    public function __construct()
    {
        $this->_modelName = new Category();
    }
    
    public function categories(Request $request)
    {
        $offset = 0;
        $limit = 10;
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
        $data = $this->_modelName->getList($offset,$limit);
    
        $message = 'success';
        $errorCode = 0;
        return $this->respondData($message,$errorCode,$data);
    }
    
}
