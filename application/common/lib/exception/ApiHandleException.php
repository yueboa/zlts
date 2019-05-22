<?php

namespace app\common\lib\exception;

use Exception;
use think\exception\Handle;
use think\exception\ValidateException;

class ApiHandleException extends Handle
{

    public function render(\Exception $e)
    {


        // 参数验证错误
        if ($e instanceof ValidateException) {

            return apierr(400, 1, $e->getError() );
        }

        $data = [];

        if ($e instanceof ApiException) {

            $httpCode = $e->httpCode;
            $message = $e->message;
            $code = $e->code;
            $data   = $e->redata;

        }else{

            $httpCode = $e->getCode();
            $message = $e->getMessage();
            $code = 999;

        }


        return apierr( $httpCode, $code, $message, $data );

    }

}