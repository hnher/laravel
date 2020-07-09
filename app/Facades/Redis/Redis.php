<?php
/**
 * Redis.php
 * Created On 2020/7/3 9:25 上午
 * Create by Retr0
 */

namespace App\Facades\Redis;

use Illuminate\Support\Facades\Facade;
use Illuminate\Redis\Limiters\DurationLimiterBuilder;
use Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder;
use Illuminate\Redis\Connections\Connection;

/**
 * @method static Connection connection(string $name = null)
 * @method static ConcurrencyLimiterBuilder funnel(string $name)
 * @method static DurationLimiterBuilder throttle(string $name)
 * @method static string|mixed|bool get(string $key)
 * @method static bool setex(string $key, int $ttl, string|mixed $value)
 * @method static bool psetex(string $key, int $ttl, string|mixed $value)
 * @method static bool setnx(string $key, string|mixed $value)
 * @method static int del(int|string|array $key1, int|string ...$otherKeys)
 * @method static bool set(string $key, string|mixed $value, int|array $timeout = null)
 * @method static Redis pipeline()
 * @method static void|array exec()
 * @method static bool|int exists(string|string[] $key)
 * @method static int incr(string $key)
 * @method static float incrByFloat(string $key, float $increment)
 * @method static int incrBy(string $key, int $value)
 * @method static int decr(string $key)
 * @method static int decrBy(string $key, int $value)
 * @method static int|bool lPush(string $key, ...$value1)
 * @method static int|bool rPush(string $key, ...$value1)
 * @method static int|bool lPushx(string $key, string|mixed $value)
 * @method static int|bool rPushx(string $key, string|mixed $value)
 * @method static mixed|bool lPop(string $key)
 * @method static mixed|bool rPop(string $key)
 * @method static array blPop(string|string[] $keys, int $timeout)
 * @method static array brPop(string|string[] $keys, int $timeout)
 * @method static int|bool lLen(string $key)
 * @method static mixed|bool lIndex(string $key, int $index)
 * @method static bool lSet(string $key, int $index, string $value)
 * @method static array lRange(string $key, int $start, int $end)
 * @method static array|bool lTrim(string $key, int $start, int $stop)
 * @method static int|bool lRem(string $key, string $value, int $count)
 * @method static lInsert(string $key, int $position, string $pivot, string|mixed $value)
 * @method static int|bool sAdd(string $key, string|mixed ...$value1)
 * @method static int sRem(string $key, string ...$member1)
 * @method static bool sMove(string $srcKey, string $dstKey, string|mixed $member)
 * @method static bool sIsMember(string $key, string|bool $value)
 * @method static int sCard(string $key)
 * @method static string|mixed|array|bool sPop(string $key, int $count = 1)
 * @method static string|mixed|array|bool sRandMember(string $key, int $count = 1)
 * @method static array sInter(string $key1, string ...$otherKeys)
 * @method static int|bool sInterStore(string $dstKey, string $key1, string ...$otherKeys)
 * @method static string[] sUnion(string $key1, string ...$otherKeys)
 * @method static int sUnionStore(string $dstKey, string $key1, string ...$otherKeys)
 * @method static string[] sDiff(string $key1, string ...$otherKeys)
 * @method static int|bool sDiffStore(string $dstKey, string $key1, string ...$otherKeys)
 * @method static array sMembers(string $key)
 * @method static array|bool sScan(string $key, int &$iterator, string $pattern = null, int $count = 0)
 * @method static string|mixed getSet(string $key, string|mixed $value)
 * @method static string randomKey()
 * @method static bool select(string $dbIndex)
 * @method static bool move(string $key, int $dbIndex)
 * @method static bool rename(string $srcKey, string $dstKey)
 * @method static bool renameNx(string $srcKey, string $dstKey)
 * @method static bool expire(string $key, int $ttl)
 * @method static bool pExpireAt(string $key, int $timestamp)
 * @method static string[] keys(string $pattern)
 * @method static bool expireAt(string $key, int $timestamp)
 * @method static int type(string $key)
 * @method static int append(string $key,string|mixed $value)
 * @method static string getRange(string $key, int $start, int $end)
 * @method static int setRange(string $key, int $offset, string $value)
 * @method static int strlen(string $key)
 * @method static array sort(string $key, array $option = [])
 * @method static int|bool ttl(string $key)
 * @method static int|bool pttl(string $key)
 * @method static bool mset(array $array)
 * @method static array mget(array $array)
 * @method static int msetnx(array $array)
 * @method static string|mixed|bool rpoplpush(string $srcKey, string $dstKey)
 * @method static string|mixed|bool brpoplpush(string $srcKey, string $dstKey, int $timeout)
 * @method static int zAdd(string $key, array|float  $options, float|string|mixed $score1, string|float|mixed $value1 = null, float|string|mixed $score2 = null, string|float|mixed $value2 = null, float|string|mixed $scoreN = null, string|float|mixed $valueN = null)
 * @method static array zRange(string $key, int $start, int $end, bool $withScores = null)
 * @method static int zRem(string $key, string|mixed $member1, string|mixed ...$otherMembers)
 * @method static array zRevRange(string $key, int $start, int $end, bool $withScore = null)
 * @method static array zRangeByScore(string $key, int $start, int $end, array $options = array())
 * @method static array zRevRangeByScore(string $key, int $start, int $end, array $options = array())
 * @method static array|bool zRangeByLex(string $key, int $min, int $max, int $offset = null, int $limit = null)
 * @method static array zRevRangeByLex(string $key, int $min, int $max, int $offset = null, int $limit = null)
 * @method static int zCount(string $key, string $start, string $end)
 * @method static int zRemRangeByScore(string $key, string|float $start, string|float $end)
 * @method static int zRemRangeByRank(string $key, int $start, int $end)
 * @method static int zCard(string $key)
 * @method static float|bool zScore(string $key, string|mixed $member)
 * @method static int|bool zRank(string $key, string|mixed $member)
 * @method static int|bool zRevRank(string $key, string|mixed $member)
 * @method static float zIncrBy(string $key, float $value, string $member)
 * @method static array zUnionStore(string $output, array $zSetKeys, array $weights = null, string $aggregateFunction = 'SUM')
 * @method static int zInterStore(string $output, array $zSetKeys, array $weights = null, string $aggregateFunction = 'SUM')
 * @method static array|bool zScan(string $key, int &$iterator, string $pattern = null, int $count = 0)
 * @method static array bzPopMax(string|array $key1, string|array $key2, int $timeout)
 * @method static array bzPopMin(string|array $key1, string|array $key2, int $timeout)
 * @method static array zPopMax(string $key, int $count = 1)
 * @method static array zPopMin(string $key, int $count = 1)
 * @method static int|bool hDel($key, $hashKey1, ...$otherHashKeys)
 * @method static int|bool hSet(string $key, string $hashKey, string $value)
 * @method static bool hSetNx(string $key, string $hashKey, string $value)
 * @method static string hGet(string $key, string $hashKey)
 * @method static int|bool hLen(string $key)
 * @method static array hKeys(string $key)
 * @method static array hVals(string $key)
 * @method static array hGetAll(string $key)
 * @method static bool hExists(string $key, string $hashKey)
 * @method static int hIncrBy(string $key, string $hashKey, int $value)
 * @method static float hIncrByFloat(string $key, string $field, float $increment)
 * @method static bool hMSet(string $key, array $hashKeys)
 * @method static array hMGet(string $key, array $hashKeys)
 * @method static array hScan(string $key, int &$iterator, string $pattern = null, int $count = 0)
 * @method static int hStrLen(string $key, string $field)
 * @method static Redis multi($mode = \Redis::MULTI)
 *
 * @see \Redis
 * @see \Illuminate\Redis\RedisManager
 * @see \Illuminate\Contracts\Redis\Factory
 */
class Redis extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'redis';
    }
}
