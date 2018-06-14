<?php
namespace App\Common\Entities\Api;

use App\Common\Untils\Appota;
use CURLFile;

class AppotaUploadImageApi {

    public static function resp($realPath) {

        $ts = time();
        $data = array(
            'file' => new CURLFile($realPath),
            'partner' => 'gamota',
            'ts' => $ts,
            'hash' => sha1(Appota::APPOTA_SECRET_KEY_UPLOAD_IMAGE . "|" . $ts),
        );
        $ch = curl_init();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'https://static.gamota.com/upload');
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result=curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        $res = json_decode($result);
        if($res->error_code == 3){
            $res->data->url = Appota::APPOTA_DEFAULT_LINK_IMAGE;
            return $res;
        }
        return res;
    }

}
