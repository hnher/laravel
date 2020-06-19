<?php
/**
 * Redis 缓存基类, 所有缓存应继承本类
 * BaseCache.php
 * Created On 2020/2/17 6:39 下午
 * Create by retr
 */

namespace App\Cache;

use Illuminate\Support\Facades\Redis;

/**
 * Class RedisCache
 * @method static string get(string $key)
 * @method static mixed hGet(string $key, string $hashKey)
 * @method static mixed hGetAll(string $key)
 * @method static mixed hDel(string $key, string $hashKey)
 * @method static Mixed hKeys(string $key)
 * @method static Mixed hExists($key, $hashKey);
 * @method static Mixed zRange($key, $start, $end);
 * @method static Mixed zRevRange($key, $start, $end, $withscore = null);
 * @method static Mixed zRem($key, $member1);
 * @method static Mixed zCard($key);
 * @method static Mixed hLen($key);
 * @method static Mixed sAdd($key, $value);
 * @method static Mixed sRem($key, $value);
 * @method static Mixed sCard($key);
 * @method static Mixed sMembers($key);
 * @method static Mixed sIsMember($key, $value);
 * @method static mixed expire(string $key, int $ttl = self::ONE_DAY)
 * @method static Mixed exists($key);
 * @method static Mixed incr($key);
 * @method static Mixed decr($key);
 * @method static Mixed decrBy($key, $value);
 * @method static Mixed lLen($key);
 * @method static Mixed lPop($key);
 * @package App\Cache
 * User retr
 */
class RedisCache extends Redis
{
    //请在此处声明常用时间，如一小时、一天、一周、一个月、一年等！
    //请不要再业务缓存内声明
    const THE_SECOND = 20;
    const TWO_HOUR = 3600 * 2;
    const ONE_DAY = 3600 * 24;
    const TWO_DAY = 3600 * 24 * 2;
    const ONE_YEAR = 3600 * 24 * 365;
    const ONE_MONTH = 3600 * 24 * 30;
    const ONE_HOUR = 3600;
    //应用缓存前缀，用于管理检索切勿更改。
    const PREFIX = 'live_';

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
    public static function hSet(string $key, string $hashKey, string $value, int $ttl = self::ONE_DAY)
    {
        $res = parent::hSet($key, $hashKey, $value);
        self::expire($key, $ttl);
        return $res;
    }

    /**
     * 修改 set 逻辑
     * @param string $key
     * @param string $value
     * @param int $ttl
     * @return bool | int
     */
    public static function set(string $key, string $value, int $ttl = self::ONE_DAY)
    {
        return parent::set($key, $value, 'EX', $ttl);
    }

    /**
     * 删除
     *
     * @param  string  $key
     *
     * @return mixed
     */
    public static function del(string $key)
    {
        return parent::del($key);
    }

    /**
     * 改写原有逻辑
     * 此处每次写入值都会更新过期时间。请注意！！！
     * @param $key
     * @param $value
     * @param $member
     *
     * @return mixed
     */
    public static function zIncrBy($key, $value, $member)
    {
        $res = parent::zIncrBy($key, $value, $member);
        self::expire($key, self::TWO_DAY);
        return $res;
    }

    /**
     * 改写原有逻辑
     * 此处每次写入值都会更新过期时间。请注意！！！
     * @param         $key
     * @param  mixed  $value1
     *
     * @return mixed
     */
    public static function rPush($key, $value1)
    {
        $res = parent::rPush($key, $value1);
        self::expire($key, self::TWO_DAY);
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
}
