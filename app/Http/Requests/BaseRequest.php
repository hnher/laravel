<?php
/**
 * BaseRequest.php
 * Created On 2020/7/6 11:36 上午
 * Create by Retr0
 */

namespace App\Http\Requests;

use Closure;
use App\Interfaces\Request\Request as RequestInterface;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use App\Traits\ProvidesConvenienceMethods;
use Illuminate\Validation\ValidationException;
use Illuminate\Routing\Router;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class BaseRequest
 * @method input(string $name, mixed $default = null)
 * @method mixed get(string $key, mixed $default = null)
 * @method string method()
 * @method string root()
 * @method string url()
 * @method string fullUrl()
 * @method string fullUrlWithQuery(array $query)
 * @method string path()
 * @method string decodedPath()
 * @method string|null  segment(int $index, $default = null)
 * @method array segments()
 * @method bool is(mixed ...$patterns)
 * @method bool routeIs(mixed ...$patterns)
 * @method bool fullUrlIs(mixed ...$patterns)
 * @method bool ajax()
 * @method bool pjax()
 * @method bool prefetch()
 * @method bool secure()
 * @method string|null ip()
 * @method array ips()
 * @method string|null userAgent()
 * @method Request merge(array $input)
 * @method Request replace(array $input)
 * @method ParameterBag|mixed json($key = null, $default = null)
 * @method static Request createFrom(Request $from, Request|null $to = null)
 * @method static Request createFromBase(SymfonyRequest $request)
 * @method Request duplicate(array $query = null, array $request = null, array $attributes = null, array $cookies = null, array $files = null, array $server = null)
 * @method Store session()
 * @method Store|null getSession()
 * @method setLaravelSession(Session $session)
 * @method mixed user(string|null $guard = null)
 * @method Router|object|string|null route(string|null $param = null, mixed $default = null)
 * @method string fingerprint()
 * @method Request setJson(ParameterBag $json)
 * @method Closure getUserResolver()
 * @method Request setUserResolver(Closure $callback)
 * @method Closure getRouteResolver()
 * @method Request setRouteResolver(Closure $callback)
 * @method array toArray()
 * @method bool offsetExists(string $offset)
 * @method mixed offsetGet(string $offset)
 * @method void offsetSet(string $offset, mixed $value)
 * @method void offsetUnset(string $offset)
 * @method bool hasSession()
 * @method void setSession(SessionInterface $session)
 * @method array getClientIps()
 * @method string|null getClientIp()
 * @method string getScriptName()
 * @method string getPathInfo()
 * @method string getBasePath()
 * @method string getBaseUrl()
 * @method string getScheme()
 * @method int|string getPort()
 * @method string getHttpHost()
 * @method string getRequestUri()
 * @method string getSchemeAndHttpHost()
 * @method string getUri()
 * @method string getUriForPath(string $path)
 * @method string getRelativeUriForPath(string $path)
 * @method string|null getQueryString()
 * @method bool isSecure()
 * @method string getHost()
 * @method void setMethod(string $method)
 * @method string getMethod()
 * @method string|null getMimeType(string $format)
 * @method string|null getFormat(?string $mimeType)
 * @method string|null getContentType()
 * @method string getDefaultLocale()
 * @method void setDefaultLocale(string $locale)
 * @method void setLocale(string $locale)
 * @method string getLocale()
 * @method bool isMethod(string $method)
 * @method bool isMethodSafe()
 * @method bool isMethodIdempotent()
 * @method string getProtocolVersion()
 * @method string|resource getContent(bool $asResource = false)
 * @method array getETags()
 * @method bool isNoCache()
 * @method array getLanguages()
 * @method array getCharsets()
 * @method array getEncodings()
 * @method array getAcceptableContentTypes()
 * @method bool isXmlHttpRequest()
 * @method bool preferSafeContent()
 * @package App\Http\Requests
 * User retr
 * @see Request;
 */
class BaseRequest implements RequestInterface
{
    use ProvidesConvenienceMethods;

    protected $request;

    /**
     * Request 对象在此时被实例化
     * BaseRequest constructor.
     * @param Request $request
     * @throws ValidationException
     */
    public function __construct(Request $request)
    {

        $this->request = $request;

        $this->validator($request, $this->rules(), $this->messages());
    }

    /**
     * 验证器
     * @param Request $request
     * @param array $rule
     * @param array $message
     * @throws ValidationException
     */
    public function validator(Request $request, array $rule = [], array $message = [])
    {
        $this->validate($request, $rule, $message);
    }

    /**
     * 验证规则
     * 请参照 laravel 的规则
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * 错误信息
     * 如果你需要自定义则参照 laravel 的规则
     * @return array
     */
    public function messages() : array
    {
        return [];
    }

    /**
     * 此处用于兼容使用 Request 对象方法。
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->request->$name($arguments);
    }
}

