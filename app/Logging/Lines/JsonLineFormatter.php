<?php
/**
 * JsonLine.php
 * Created On 2020/6/18 2:50 下午
 * Create by Retr0
 */

namespace App\Logging\Lines;

use App\Facades\Json\Json;
use Illuminate\Support\Str;
use Monolog\Formatter\LineFormatter;
use Monolog\Formatter\NormalizerFormatter;

class JsonLineFormatter extends LineFormatter
{
    /**
     * 格式化
     * @param array $record
     * @return string
     */
    public function format(array $record) : string
    {
        $port = $_SERVER['SERVER_PORT'] ?? 80;
        $protocol = $port == 443 ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'] ?? '';
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $referer = $_SERVER['HTTP_REFERER'] ?? '';
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $url = $protocol . $host . $uri;
        $cookies = Json::encode($_COOKIE ?? "");
        if (strpos(php_sapi_name(), 'cli') !== false) {
            $url = 'artisan';
            $referer = 'artisan';
            $ua = 'php artisan';
        }

        $datetime = date('Y-m-d H:i:s', time());

        $output = '{"datetime": "'. $datetime .'", "timestamp": "%datetime%", "url": "'. $url .'", "UA": "'. $ua .'", "referer": "'. $referer .'", "uuid": %uuid%, "channel": "%channel%", "level": "%level_name%", "message": "%message%", "context": [%context%], "extra": %extra%, "cookies": '. $cookies .'}' . "\n";;
        $vars   = (new NormalizerFormatter())->format($record);
        $vars['channel'] = $vars['context']['channel'] ?? 'local';
        $vars['uuid'] = app('app')->uuid;
        foreach ($vars['extra'] as $var => $val) {
            if (false !== strpos($output, '%extra.' . $var . '%')) {
                $output = str_replace('%extra.' . $var . '%', $this->stringify($val), $output);
                unset($vars['extra'][$var]);
            }
        }
        if (isset($vars['context']['exception']) && !empty($vars['context']['exception'])) {
            $vars['message'] = '';
            $vars['context'] = $vars['context']['exception'];
            if (isset($vars['context']['trace'])) {
                unset($vars['context']['trace']);
            }
            if (isset($vars['context']['previous'])) {
                unset($vars['context']['previous']);
            }
        }

        if (false !== strpos($output, '%')) {
            $output = preg_replace('/%(?:extra|context)\..+?%/', '', $output);
        }

        foreach ($vars as $var => $val) {
            if (false !== strpos($output, '%' . $var . '%')) {
                $output = str_replace('%' . $var . '%', $this->stringify($val), $output);
            }
        }
        // remove leftover %extra.xxx% and %context.xxx% if any
        if (false !== strpos($output, '%')) {
            $output = preg_replace('/%(?:extra|context)\..+?%/', '', $output);
        }

        return $output;
    }
}
