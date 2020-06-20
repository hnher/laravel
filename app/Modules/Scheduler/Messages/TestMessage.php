<?php
/**
 * TestMessage.php
 * Created On 2020/6/19 4:43 下午
 * Create by Retr0
 */

namespace App\Modules\Scheduler\Messages;


class TestMessage extends Message
{
    public function __construct(string $cmd = 'Scheduler:Test', array $params = [], string $key = '', int $delay = 10)
    {
        parent::__construct($cmd, $params, $key, $delay);
    }
}
