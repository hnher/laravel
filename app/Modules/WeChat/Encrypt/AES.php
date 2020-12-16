<?php


namespace App\Modules\WeChat\Encrypt;

use InvalidArgumentException;

class AES
{
    /**
     * @param string $text
     * @param string $key
     * @param string $iv
     * @param int $option
     *
     * @return string
     */
    public static function encrypt(string $text, string $key, string $iv, int $option = OPENSSL_RAW_DATA): string
    {
        self::validateKey($key);
        self::validateIv($iv);

        return openssl_encrypt($text, self::getMode($key), $key, $option, $iv);
    }

    /**
     * 解密
     * @param string $cipherText encryptedData
     * @param string $key session_key
     * @param string $iv iv
     * @param int $option
     * @param null $method
     *
     * @return string
     */
    public static function decrypt(string $cipherText, string $key, string $iv, int $option = OPENSSL_RAW_DATA, $method = null): string
    {
        self::validateKey($key);
        self::validateIv($iv);

        return openssl_decrypt($cipherText, $method ?: self::getMode($key), $key, $option, $iv);
    }

    public static function getMode($key)
    {
        return 'aes-' . (8 * strlen($key)) . '-cbc';
    }

    /**
     * 效验 sessionKey 正确性
     * @param string $key
     */
    public static function validateKey(string $key)
    {
        if (!empty($key) && strlen($key) != 24) {
            throw new InvalidArgumentException(sprintf('Key length must be 16, 24, or 32 bytes; got key len (%s).', strlen($key)));
        }
    }

    /**
     * 效验 IV 正确性
     * @param string $iv
     */
    public static function validateIv(string $iv)
    {
        if (!empty($iv) && 24 !== strlen($iv)) {
            throw new InvalidArgumentException('IV length must be 16 bytes.');
        }
    }
}
