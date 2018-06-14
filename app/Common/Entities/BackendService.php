<?php
namespace App\Common\Models;
/**
 * Created by IntelliJ IDEA.
 * User: akke
 * Date: 5/29/18
 * Time: 11:13 AM
 */
class BackendService
{
    public $path;
    private $_header;

    public function __construct($accessToken = null) {
        $this->_setHeader($accessToken);
    }

    private function _setHeader($accessToken) {
        $this->_header['access_token'] = $accessToken;
        $this->_header['Content-Type'] = 'application/json';
    }

    protected function getHeader() {
        return $this->_header ? $this->_header : null;
    }

    protected function setPath($path) {
        $this->path = $path;
    }

    protected function getPath() {
        return $this->path ? $this->path : null;
    }
}
