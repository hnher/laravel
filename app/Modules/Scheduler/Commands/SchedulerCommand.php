<?php
/**
 * SchedulerCommand.php
 * Created On 2020/6/19 2:55 下午
 * Create by Retr0
 */

namespace App\Modules\Scheduler\Commands;

use Illuminate\Console\Command;

/**
 * 任务基类
 * 所有基于 Scheduler 任务需要继承本类
 * Class SchedulerCommand
 * @package App\Modules\Scheduler\Commands
 * User retr
 */
class SchedulerCommand extends Command
{
    /**
     * 用于标识任务被分发到的 Topic
     * @var string
     */
    public $topic = '';

    /**
     * SchedulerCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 标记任务完成了
     */
    public function finish()
    {

    }

    public function error($string, $verbosity = null)
    {

    }
}
