<?php
/**
 * 用于将所有响应 JSON 格式化
 * ResponseMiddleware.php
 * Created On 2020/2/17 5:29 下午
 * Create by retr
 */

namespace App\Http\Middleware;

use App\Constants\ErrorConstant;
use App\Facades\Json\Json;
use Exception as BaseException;
use Closure;
use Illuminate\Http\Response as HttpResponse;
use stdClass;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Response
{
    private $timer = 0;

    public function __construct()
    {
        $this->timer = time();
    }

    //设置排除的路由 例如：/api/*
    //设置后则不会被格式化
    protected $except = [

    ];

    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        //此处排除特定路由不格式化输出
        if ($this->inExceptArray($request)) {
            return $response;
        }

        $data = [
            'code' => $response->getStatusCode(),
            'message' => 'ok',
            'time' => $this->timer,
            'dateTime' => date('Y-m-d H:i:s', $this->timer),
            'data' => new stdClass()
        ];
        $exception = $response->exception;
        //异常单独处理
        if ($exception !== null) {
            /**
             * 此处处理 HTTP 异常
             * 如 404 ， 403 ，500
             */
            if ($exception instanceof HttpException) {
                $data['code'] = $response->getStatusCode();
                $data['message'] = ErrorConstant::HTTP_ERROR[$response->getStatusCode()] ?? HttpResponse::$statusTexts[$response->getStatusCode()];
                $response->setContent(Json::encode($data));
                //此处必须提前 return 因为所有的异常类均继承 Exception 类
                return $response;
            }

            /**
             * 此处处理自定义异常
             */
            if ($exception instanceof BaseException) {
                $data['code'] = $exception->getCode();
                $data['message'] = $exception->getMessage();
                $response->setContent(Json::encode($data));
                return $response;
            }
        } else {

            //此处用于处理验证器异常
            if ($response->getStatusCode() == 422) {
                $data['message'] = HttpResponse::$statusTexts[$response->getStatusCode()];
                $data['data'] = ['validators' => json_decode($response->getContent())];
                $response->setContent(Json::encode($data));
                return $response;
            }

            $data['data'] = empty($response->original) ? new stdClass() : $response->original;
            $response->setContent(Json::encode($data));
        }

        return $response;
    }

    protected function inExceptArray($request)
    {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->fullUrlIs($except) || $request->is($except)) {
                return true;
            }
        }

        return false;
    }
}
