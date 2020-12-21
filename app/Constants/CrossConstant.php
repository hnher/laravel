<?php
/**
 * CrossConstant.php
 * Created On 2020/3/31 2:19 下午
 * Create by Retr0
 */

namespace App\Constants;


class CrossConstant
{
    const HEADERS = [
        'Access-Control-Allow-Methods' => 'GET, POST, HEADER, OPTION, PUT, DELETE',
        'Access-Control-Allow-Headers' => 'Origin, Content-Type, Cookie, X-CSRF-TOKEN, Accept, Authorization, X-XSRF-TOKEN',
        'Access-Control-Allow-Credentials' => 'true', //允许客户端发送cookie
        'Access-Control-Max-Age' => 1728000,
    ];
}
