<?php
namespace App\Modules\Cms\Http\Controllers;

use App\Common\Untils\Regular;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;


class ServiceController extends Controller {


    public function __construct()
    {
        $this->middleware('cms');
    }

    public function response($success = false, $message = null, $data = [], $options = []) {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
            'options' => $options
        ]);
    }

    public function getValidateErrs($errors, $msg = '') {
        if (empty($errors)) {
            return $msg;
        }
        foreach ($errors as $val) {
            if(empty($msg)){
                $msg = $val;
            }else{
                $msg = $msg . '. ' . $val;
            }
        }
        return $msg;
    }
}
