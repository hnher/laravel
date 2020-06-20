<?php
/**
 * Scheduler.php
 * Created On 2020/6/19 2:38 下午
 * Create by Retr0
 */

namespace App\Modules\Scheduler;


use App\Modules\Scheduler\Messages\Message;

class Scheduler
{
    /**
     * 发生消息
     * @param Message $message
     * @param string $topic
     * @param string $instanceId
     * @return mixed
     */
    public function sendMessage(Message $message, string $topic = '', string $instanceId = '')
    {
        $producer = (new Client())->getProducer($topic, $instanceId);

        return $producer->publishMessage($message);
    }
}
