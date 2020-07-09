<?php
/**
 * SMS.php
 * Created On 2020/7/1 3:15 下午
 * Create by Retr0
 */

namespace App\Facades\SMS;

use Illuminate\Support\Facades\Facade;
use Overtrue\EasySms\EasySms;

/**
 * Class SMS
 * @method static send($to, $message, array $gateways = [])
 * @package App\Facades\SMS
 * User retr
 */
class SMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return new EasySms(config('sms'));
    }
}
