<?php
/**
 * Scheduler.php
 * Created On 2020/6/19 4:49 下午
 * Create by Retr0
 */

namespace App\Facades\Scheduler;

use App\Modules\Scheduler\Messages\Message;
use Illuminate\Support\Facades\Facade;
use App\Modules\Scheduler\Scheduler as SchedulerModule;

/**
 * Class Scheduler
 * 发生消息
 * @method static mixed sendMessage(Message $message, string $topic = '', string $instanceId = '')
 * @package App\Facades\Scheduler
 * User retr
 */
class Scheduler extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SchedulerModule::class;
    }
}
