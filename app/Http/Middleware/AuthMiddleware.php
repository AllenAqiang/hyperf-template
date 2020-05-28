<?php

namespace App\Http\Middleware;

use App\Constants\ErrorCode;
use App\Exception\ApiException;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Hyperf\JwtAuth\Jwt;
use Hyperf\JwtAuth\Exception\TokenValidException;
use Hyperf\Utils\Context;
use Hyperf\Utils\Arr;

class AuthMiddleware implements MiddlewareInterface
{
    /**
     * @var HttpResponse
     */
    protected $response;

    protected $prefix = 'Bearer';

    protected $jwt;

    public function __construct(HttpResponse $response, Jwt $jwt)
    {
        $this->response = $response;
        $this->jwt = $jwt;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws \Throwable
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $request = $this->initRequest($request);

        $isValidToken = false;
        // 根据具体业务判断逻辑走向，这里假设用户携带的token有效
        $token = $request->getHeader('Authorization')[0] ?? '';

        if (strlen($token) > 0) {
            $token = ucfirst($token);
            $arr = explode($this->prefix . ' ', $token);
            $token = $arr[1] ?? '';
            if (strlen($token) > 0 && $this->jwt->checkToken()) {
                $parserData = $this->jwt->getParserData();
                $user = [
                    'id' => $parserData['id'],
                ];
                $request = Context::override(ServerRequestInterface::class, function (ServerRequestInterface $request) use ($user) {
                    return $request->withAttribute('user', $user);
                });
                $isValidToken = true;
            }
        }

        if ($isValidToken) {
            return $handler->handle($request);
        }

        throw new ApiException(ErrorCode::AUTH_ERROR);
    }

    /**
     * 初始化请求，将query token 转换成 header token
     *
     * @param ServerRequestInterface $request
     * @return ServerRequestInterface
     */
    protected function initRequest(ServerRequestInterface $request)
    {
        $queryParams = $request->getQueryParams();

        if (!Arr::has($queryParams, 'access_token')) {
            return $request;
        }

        $accessToken = Arr::get($queryParams, 'access_token');

        $request = $request->withAddedHeader('Authorization', 'Bearer '.$accessToken);
        Context::set(ServerRequestInterface::class, $request);
        return $request;
    }
}
