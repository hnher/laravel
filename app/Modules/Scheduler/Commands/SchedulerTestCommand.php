<?php
/**
 * SchedulerTestCommand.php
 * Created On 2020/6/19 4:47 下午
 * Create by Retr0
 */

namespace App\Modules\Scheduler\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SchedulerTestCommand extends Command
{
    protected $signature = 'Scheduler:Test';

    protected $description = 'Scheduler 测试脚本';

    public function handle()
    {
        Log::info('Scheduler 任务运行了...');
    }
}
