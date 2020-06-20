<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## 框架的手脚架

简化基于 Laravel 新项目初始化的时间。

## 已完成功能

1. 日志 JSON 化
2. 缓存基类设置
3. 允许跨域请求
4. 统一格式化返回
6. Makefile 自动脚本
7. 基于 RocketMQ 的秒级任务调度

## 使用

```bash
composer create-project hnher/laravel LaravelApp
```

## 延时任务

延时任务基于阿里云 RocketMQ 和 pm2 搭建。RocketMQ 作为消息传递、pm2 作为进程守护

### 服务器需求

1. 阿里云 RocketMQ
2. pm2

### 编写任务消息实例

```php
namespace App\Modules\Scheduler\Messages;


class TestMessage extends Message
{
    public function __construct(string $cmd = 'Scheduler:Test', array $params = [], string $key = '', int $delay = 10)
    {
        parent::__construct($cmd, $params, $key, $delay);
    }
}
```

### 发送延时任务消息

可以在代码任何地方使用 Scheduler 门面的 sendMessage 方法发送消息实例

```php
namespace App\Console\Commands;

use App\Facades\Scheduler\Scheduler;
use App\Modules\Scheduler\Messages\TestMessage;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'Test:Test';

    protected $description = '测试使用脚本';

    /**
     * 业务处理
     */
    public function handle()
    {
        $res = Scheduler::sendMessage(new TestMessage());

        dd($res);
    }
}
```

### 消费任务消息

可以在 ecosystem.config.js 文件中指定运行实例和其他配置，也可以继承 ConsumerCommand 自定义消费

```bash
pm2 start ecosystem.config.js
```

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
