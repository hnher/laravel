<?php
/**
 * 请将所有的异常状态码和文字描述在此处定义
 * ErrorConstant.php
 * Created On 2020/2/19 10:47 上午
 * Create by retr
 */

namespace App\Constants;


class ErrorConstant
{
    /**
     * 此处声明对应的 HTTP 状态码返回文字信息，用于覆盖原有的 HTTP 状态信息
     */
    const HTTP_ERROR = [
        404 => '接口不存在'
    ];
}
