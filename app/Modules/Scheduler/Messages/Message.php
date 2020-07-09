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
    /**
     * @var string 设置调用的命令
     */
    public $cmd = '';

    public function __construct(array $params = [], int $delay = 0, string $key = '')
    {
        parent::__construct(Json::encode(['cmd' => $this->cmd, 'params' => $params]));

        if ($delay > 0) {
            $this->setStartDeliverTime((time() + $delay) * 1000);
        }

        if (!empty($key)) {
            $this->setMessageKey($key);
        }

        $this->setMessageBody(Json::encode(['cmd' => $this->cmd, 'params' => $params]));
    }
}
