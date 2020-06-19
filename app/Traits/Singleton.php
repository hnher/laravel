<?php
/**
 * 本 Trait 用于将 Class 改变为单例模式，主要应用于服务层。
 * BaseTraits.php
 * Created On 2020/2/17 5:00 下午
 * Create by retr
 */

namespace App\Traits;

trait Singleton
{
    private static $instance;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
