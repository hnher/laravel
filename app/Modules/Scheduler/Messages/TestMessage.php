<?php
/**
 * TestMessage.php
 * Created On 2020/6/19 4:43 下午
 * Create by Retr0
 */

namespace App\Modules\Scheduler\Messages;


class TestMessage extends Message
{
    public $cmd = 'Scheduler:Test';

    public function __construct(array $params = [], int $delay = 10, string $key = '')
    {
        parent::__construct($params, $delay, $key);
    }
}
