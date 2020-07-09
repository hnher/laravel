<?php
/**
 * Redis 缓存基类, 所有缓存应继承本类
 * BaseCache.php
 * Created On 2020/2/17 6:39 下午
 * Create by retr
 */

namespace App\Cache;

use App\Facades\Redis\Redis;

/**
 * Class RedisCache
 * @package App\Cache
 * User retr
 */
class Cache extends Redis
{
    //请在此处声明常用时间，如一小时、一天、一周、一个月、一年等！

    //一分钟
    const ONE_MINUTE = 60;

    //一小时
    const ONE_HOUR = 3600;

    //一天
    const ONE_DAY = self::ONE_HOUR * 24;

    //一个月
    const ONE_MONTH = self::ONE_DAY * 30;

    //一年
    const ONE_YEAR = self::ONE_DAY * 365;

    const FOREVER = -1;

    /**
     * PREFIX 缓存前缀
     */
    const PREFIX = '';

    /**
     * 用于格式化每个 Key 序列
     * @example self::getKey('abc_%s_%s', 1, 2)
     * @param string $str
     * @param mixed ...$keys
     * @return string
     */
    public static function getKey(string $str, ...$keys)
    {
        return vsprintf(self::PREFIX . $str, $keys);
    }

    /**
     * 为mGet做准备,变成数组键值
     * @param string $key 键值
     * @param array  $arr 匹配的数组队
     * @return array
     */
    public static function getMoreKey($key, $arr)
    {
        $tmpArr = [];
        foreach ($arr as $v) {
            if (!is_array($v)) {
                $v = [$v];
            }

            $tmpArr['keyGroup'][] = call_user_func_array('self::getKey', array_merge([$key], $v));
        }
        $tmpArr['idGroup'] = $arr;
        return $tmpArr;
    }

    /**
     * 改写 原有的 hSet 逻辑
     * 此处每次写入值都会更新过期时间。请注意！！！
     * @param string $key
     * @param string $hashKey
     * @param string $value
     * @param int $ttl
     * @return bool | int
     */
    public static function hSet(string $key, string $hashKey, string $value, int $ttl = self::FOREVER)
    {
        $res = parent::hSet($key, $hashKey, $value);
        self::expire($key, $ttl);
        return $res;
    }

    /**
     * 改写原有逻辑
     * 此处每次写入值都会更新过期时间。请注意！！！
     * @param string $key
     * @param float $value
     * @param string $member
     * @param int $ttl
     * @return float
     */
    public static function zIncrBy(string $key, float $value, string $member, int $ttl = self::FOREVER)
    {
        $res = parent::zIncrBy($key, $value, $member);
        self::expire($key, $ttl);
        return $res;
    }

    /**
     * 改写原有逻辑
     * 此处每次写入值都会更新过期时间。请注意！！！
     * @param string $key
     * @param array  $value1
     * @param int $ttl
     *
     * @return mixed
     */
    public static function rPush(string $key, array $value1, int $ttl = self::FOREVER)
    {
        $res = parent::rPush($key, $value1);
        self::expire($key, $ttl);
        return $res;
    }

    /**
     * 设置当天时间
     * @return false|string
     */
    public static function getDayDateString()
    {
        return date('Ymd', time());
    }

    /**
     * 设置当天时间
     * @return false|string
     */
    public static function getDateTimeString()
    {
        return date('YmdHis', time());
    }

    /**
     * 批量获取,自动根据传进来的ID排序
     * @param array $array 包含idGroup(键),keyGroup2个组
     * @return array
     */
    public static function mGet(array $array)
    {
        $list = parent::mget($array['keyGroup']);
        foreach ($list as $k => $v) {
            $list[$k] = $v;
        }
        return array_combine($array['idGroup'], $list);
    }

    /**
     * 批量删除 Hash 子 key
     * @param string $key Hash Key 名称
     * @param array $subKeys Hash 子Key 名称
     * @return int | bool
     */
    public static function hMDel(string $key, array $subKeys = [])
    {
        if (count($subKeys) == 0) {
            return 0;
        }

        return parent::hDel($key, $subKeys[0], ...$subKeys);
    }
}
