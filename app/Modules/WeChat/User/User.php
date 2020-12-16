<?php
/**
 * User.php
 * Created On 2020/7/11 11:18 上午
 * Create by Retr0
 */

namespace App\Modules\WeChat\User;

use App\Facades\Json\Json;
use App\Modules\WeChat\Encrypt\Encrypt;
use App\Modules\WeChat\Exceptions\DecryptException;
use App\Modules\WeChat\Exceptions\WeChatException;
use App\Modules\WeChat\WeChat;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class User extends WeChat
{
    const CODE_TO_SESSION_URL = 'https://api.weixin.qq.com/sns/jscode2session';

    /**
     * 微信 Code 换取 Session
     * @param string $appId
     * @param string $secret
     * @param string $code
     * @param string $grantType
     * @return array|mixed
     * @throws Exception
     */
    public function codeToSession(string $appId, string $secret, string $code, string $grantType = 'authorization_code')
    {
        $params = [
            'appid' => $appId,
            'secret' => $secret,
            'js_code' => $code,
            'grant_type' => $grantType
        ];

        Log::info('换取Session参数为', $params);

        $response = Http::get(self::CODE_TO_SESSION_URL, $params)->json();

        if (!empty($response['errcode']) && $response['errcode'] != 0) {
            Log::error('获取 SessionKey 错误', $response);
            throw new WeChatException('Code To Session 错误');
        }

        return $response;
    }

    /**
     * 解密数据
     * @param string $appId
     * @param string $encryptedData
     * @param string $iv
     * @param string $sessionKey
     * @return mixed
     * @throws Exception
     */
    public function decryptUserData(string $appId, string $encryptedData, string $iv, string $sessionKey)
    {
        $pc = new Encrypt($appId, $sessionKey);
        $data = Json::decode($pc->decryptData($encryptedData, $iv));

        if (empty($data['openId'])) {
            Log::error('获取微信资料失败', [$data]);
            throw new DecryptException('获取微信资料失败!');
        }

        return $data;
    }
}
