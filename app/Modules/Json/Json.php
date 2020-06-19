<?php
/**
 * Json.php
 * Created On 2020/6/18 3:34 下午
 * Create by Retr0
 */

namespace App\Modules\Json;

/**
 * 需要统一解码和编码，防止空数组空对象互转问题。
 * Class Json
 * @package App\Models\Json
 * User retr
 */
class Json
{
    /**
     * 对象转成 json
     * @param $obj
     * @return false|string
     */
    public function encode($obj)
    {
        return json_encode($obj);
    }

    /**
     * 解析 json 字符串
     * @param string $str
     * @return mixed
     */
    public function decode(string $str)
    {
        return json_decode($str, true, 512);
    }
}
