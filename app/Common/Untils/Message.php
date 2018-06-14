<?php
namespace App\Common\Untils;

class Message {
    public static function buildMsgAction($status, $msg = '')
    {
        $raw = [];
        switch ($status) {
            case 'danger':
                $raw['msg']['alert'] = $status;
                $raw['msg']['message'] = $msg ?: 'Your action system processing is ' . $status . '!';
                break;
            case 'warning':
                $raw['msg']['alert'] = $status;
                $raw['msg']['message'] = $msg ?: 'Your action system processing is ' . $status . '!';
                break;
            case 'success':
                $raw['msg']['alert'] = $status;
                $raw['msg']['message'] = $msg ?: 'Your action system processing is ' . $status . '!';
                break;
            default:
                $raw['msg']['alert'] = 'danger';
                $raw['msg']['message'] = $msg ?: 'Your action system processing is don\'t know!';
                break;
        }
        return $raw;
    }
}
