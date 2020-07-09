<?php
/**
 * Upload.php
 * Created On 2020/7/1 2:43 下午
 * Create by Retr0
 */

namespace App\Facades\QiNiu;

use Illuminate\Support\Facades\Facade;
use Qiniu\Auth as QiNiuAuth;

/**
 * Class Auth
 * @method static uploadToken($bucket, $key = null, $expires = 3600, $policy = null, $strictPolicy = true)
 * @package App\Facades\QiNiu
 * User retr
 */
class Auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return new QiNiuAuth(config('qiniu.accessKey'), config('qiniu.secretKey'));
    }
}
