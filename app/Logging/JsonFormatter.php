<?php
/**
 * JsonFormatter.php
 * Created On 2020/6/18 2:46 下午
 * Create by Retr0
 */

namespace App\Logging;

use App\Logging\Lines\JsonLineFormatter;

class JsonFormatter
{
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new JsonLineFormatter());
        }
    }
}
