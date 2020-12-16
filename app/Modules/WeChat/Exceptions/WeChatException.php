<?php
/**
 * WeChatException.php
 * Created On 2020/7/16 9:37 上午
 * Create by Retr0
 */

namespace App\Modules\WeChat\Exceptions;

use Exception;
use Throwable;

class WeChatException extends Exception
{
    public function __construct($message = "", $code = 6000, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
