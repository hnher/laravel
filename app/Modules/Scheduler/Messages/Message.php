<?php
/**
 * BaseMessage.php
 * Created On 2020/6/19 4:36 下午
 * Create by Retr0
 */

namespace App\Modules\Scheduler\Messages;

use App\Facades\Json\Json;
use MQ\Model\TopicMessage;

class Message extends TopicMessage
{
    public function __construct(string $cmd, array $params = [], string $key = '',int $delay = 0)
    {
        parent::__construct(Json::encode(['cmd' => $cmd, 'params' => $params]));

        if ($delay > 0) {
            $this->setStartDeliverTime((time() + $delay) * 1000);
        }

        if (!empty($key)) {
            $this->setMessageKey($key);
        }

        $this->setMessageBody(Json::encode(['cmd' => $cmd, 'params' => $params]));
    }
}
