<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/7
 * Time: 下午10:45
 */
namespace app\common\lib\exception;
use think\Exception;

class ApiException extends Exception {

    public $message = '';
    public $httpCode = 500;
    public $code = 0;

    /**
     * @param string $message
     * @param int $httpCode
     * @param int $code
     */
    public function __construct($httpCode = 0, $code = 0, $message = '', $data=[]) {

        $this->httpCode = $httpCode;
        $this->code = $code;
        $this->message = $message;
        $this->redata =   $data;

    }
}