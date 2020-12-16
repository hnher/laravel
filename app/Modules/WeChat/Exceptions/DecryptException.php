<?php


namespace App\Modules\WeChat\Exceptions;


use Throwable;

class DecryptException extends WeChatException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
