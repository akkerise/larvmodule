<?php

namespace App\Common\Entities\Api;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use App\Common\Entities\Api\Response;
use GuzzleHttp\Client;

class RestApi {

    private $_response;
    private $_data;
    protected $_header;
    protected $_client;
    protected $_path;

    /**
     * Response data from API
     * @return object Response
     */
    public function getRespone() {
        return $this->_data;
    }

    /**
     * Call API method GET
     * @param string $path
     */
    public function get() {
        $this->_response = $this->_client->get($this->_path);
        $this->_formatResponse($this->_response);
    }

    /**
     * Call API method POST
     * @param string $path
     * @param array $body
     */
    public function post($body = []) {
        $this->_response = $this->_client->post($body, $this->_path);
        $this->_formatResponse($this->_response);
    }

    /**
     * Call API method PUT
     * @param string $path
     * @param array $body
     */
    public function put($body = []) {
        $this->_response = $this->_client->put($body, $this->_path);
        $this->_formatResponse($this->_response, false);
    }

    /**
     * Call API method DELETE
     * @param string $path
     */
    public function delete() {
        $this->_response = $this->_client->delete($this->_path);
        $this->_formatResponse($this->_response);
    }

    /**
     * Format response from API
     * @param object response
     */
    private function _formatResponse($response, $isQuery = true, $datas = []) {
        try {
            $datas['headers'] = $response->headers;
            if ($isQuery) {
                $datas['body'] = $response->data;
            }
            if ($response->getReasonPhrase() === (string)'OK') {
                $this->_data = new Response(true, $this->_getMsgHttpCode($response->getStatusCode()), $datas);
            } else {
                $this->_data = new Response(false, $this->_getMsgError(!empty($response->data['message']) ? $response->data['message'] : $response->data['error']), $datas);
            }
        } catch (GuzzleException $ex) {
            $this->_data = new Response(false, $ex->getMessage(), []);
            if ($ex->hasResponse()) {
                $this->_data = new Response(false, $ex->getResponse(), []);
            }else{
                $this->_data = new Response(false, $ex->getRequest(), []);
            }
        }
    }

    private function _getMsgError($body) {
        return json_encode($body);
    }

    /**
     * Get description httpcode
     * @param type $httpCode
     * @param type $msg
     * @return string $msg
     */
    private function _getMsgHttpCode($httpCode, $msg = '') {
        switch ($httpCode) {
            case 200:
                $msg = 'OK';
                break;
            case 400:
                $msg = 'Bad request';
                break;
            case 401:
                $msg = 'Authorization Required';
                break;
            case 403:
                $msg = 'Forbidden';
                break;
            case 404:
                $msg = 'Not Found';
                break;
            case 408:
                $msg = 'Request Time-out';
                break;
            case 500:
                $msg = 'Internal Server Error';
                break;
            case 503:
                $msg = 'Service Unavailable';
                break;
            case 504:
                $msg = 'Gateway Time-out';
                break;
            default :
                $msg = $httpCode;
                break;
        }
        return $msg;
    }

}
