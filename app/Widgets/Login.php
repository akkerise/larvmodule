<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Cookie;
use Session;

class Login extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];
    private $client = '973260286001234';
    private $redirect_uri = 'http://h5.gamota.test:8000/login/wallet';
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $endPoint = 'https://login.appota.com/oauth/request_token?client_id='.$this->client.'&response_type=code&redirect_uri='.$this->redirect_uri.'&scope=user.info&state=vn&lang=vi';
        $cookie = Cookie::get();
        return view('widgets.login', [
            'config' => $this->config,
            'endPoint' =>$endPoint,
            'isLogged' => isset($cookie['access_token']) ? $cookie['access_token'] : null,
            'cookie' => $cookie
        ]);
    }
}
