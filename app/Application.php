<?php
/**
 * Application.php
 * Created On 2020/6/19 10:41 上午
 * Create by Retr0
 */

namespace App;

use Illuminate\Foundation\Application as BaseApplication;
use Illuminate\Support\Str;

/**
 * 应用程序实例
 * Class Application
 * @package App
 * User retr
 */
class Application extends BaseApplication
{
    /**
     * 初始化应用程序
     * Application constructor.
     * @param null $basePath
     */
    public function __construct($basePath = null)
    {
        parent::__construct($basePath);
    }

    public function boot()
    {
        app('app')->uuid = Str::uuid();
    }
}
