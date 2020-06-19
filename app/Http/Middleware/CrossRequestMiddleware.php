<?php
/**
 * CrossRequestMiddleware.php
 * Created On 2020/3/31 2:17 下午
 * Create by Retr0
 */

namespace App\Http\Middleware;

use App\Constants\CrossConstant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CrossRequestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

        //如果是复杂请求，先返回一个200，并allow该origin
        if ($request->isMethod('options')) {
            return $this->setCorsHeaders(new Response('OK', 200), $origin);
        }
        //如果是简单请求或者非跨域请求，则照常设置header
        $response = $next($request);
        $methodVariable = array($response, 'header');

        //这个判断是因为在开启session全局中间件之后，频繁的报header方法不存在，所以加上这个判断，存在header方法时才进行header的设置
        if (is_callable($methodVariable, false, $callable_name)) {
            return $this->setCorsHeaders($response, $origin);
        }
        return $response;
    }

    /**
     * @param Response $response
     * @param $origin
     * @return Response
     */
    public function setCorsHeaders($response, $origin)
    {
        foreach (CrossConstant::HEADERS as $key => $value) {
            $response->header($key, $value);
        }

        $response->header('Access-Control-Allow-Origin', $origin);

        return $response;
    }
}
