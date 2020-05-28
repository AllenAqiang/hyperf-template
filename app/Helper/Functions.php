<?php
declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

use App\Helper\JwtHelper;
use Hyperf\AsyncQueue\Driver\DriverFactory;
use Hyperf\AsyncQueue\JobInterface;
use Hyperf\ExceptionHandler\Formatter\FormatterInterface;
use Hyperf\Utils\ApplicationContext;
if (! function_exists('di')) {
    /**
     * Finds an entry of the container by its identifier and returns it.
     * @param null|mixed $id
     * @return mixed|\Psr\Container\ContainerInterface
     */
    function di($id = null)
    {
        $container = ApplicationContext::getContainer();
        if ($id) {
            return $container->get($id);
        }
        return $container;
    }
}
if (! function_exists('format_throwable')) {
    /**
     * Format a throwable to string.
     */
    function format_throwable(Throwable $throwable): string
    {
        return di()->get(FormatterInterface::class)->format($throwable);
    }
}
if (! function_exists('queue_push')) {
    /**
     * Push a job to async queue.
     */
    function queue_push(JobInterface $job, int $delay = 0, string $key = 'default'): bool
    {
        $driver = di()->get(DriverFactory::class)->get($key);
        return $driver->push($job, $delay);
    }
}
if (!function_exists('apiSuccess')) {

    /**
     * @param $data
     * @param int $code
     * @param string $msg
     * @return
     */
    function apiSuccess($data = [], $code = 0, $msg = 'Success')
    {
        $result = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        return di() ->get(\Hyperf\HttpServer\Contract\ResponseInterface::class) ->json($result);
    }
}
if (!function_exists('apiError')) {


    /**
     * @param $code
     * @param string $msg
     * @return
     */
    function apiError($code = -1, $msg = 'Error')
    {
        $code = ($code == 0) ? -1 : $code;
        $msg = ErrorCode::getMessage($code) ?? $msg;
        $result = [
            'code' => $code,
            'msg' => $msg,
            'data' => null
        ];
        return di() ->get(\Hyperf\HttpServer\Contract\ResponseInterface::class) ->json($result);
    }
}


if (!function_exists('throwApiException')) {
    /**
     * @param $code
     * @param string $msg
     * @param string $file
     * @param string $trace
     * @return
     */
    function throwApiException($code, $msg = 'Error', $file = '', $trace = '')
    {
        $result = [
            'code' => $code,
            'msg' => $msg,
            'data' => null
        ];
        if (env('APP_DEBUG')) {
            $result = array_merge($result, [
                'file' => $file,
                'trace' => $trace
            ]);
        }
        return di() ->get(\Hyperf\HttpServer\Contract\ResponseInterface::class) ->json($result);
    }
}
if (!function_exists('checkAuth')) {
    function checkAuth()
    {
        $request = di() ->get(\Hyperf\HttpServer\Contract\RequestInterface::class) ->getBody();
        $token = $request->getCookieParams()['IM_TOKEN'] ?? '';
        if (!$token || !is_string($token) || !$userId = JwtHelper::decrypt($token)) {
            return false;
        }
        $userInfo = bean('App\Model\Dao\UserDao')->findUserInfoById($userId);
        if (!$userInfo) {
            return false;
        }
        $request->user = $userId;
        $request->userInfo = $userInfo;

        return $userId;
    }
}

if (!function_exists('wsSuccess')) {
    function wsSuccess($cmd = \App\Common\WsMessage::WS_MESSAGE_CMD_EVENT, $method = '', $data = [], $msg = 'Success')
    {
        $result = [
            'cmd' => $cmd,
            'method' => $method,
            'msg' => $msg,
            'data' => $data
        ];

        return json_encode($result);
    }
}

if (!function_exists('wsError')) {
    function wsError($msg = 'Error', $cmd = \App\Common\WsMessage::WS_MESSAGE_CMD_ERROR, $data = [])
    {
        $result = [
            'cmd' => $cmd,
            'msg' => $msg,
            'data' => $data
        ];
        return json_encode($result);
    }
}
//if (! function_exists('amqp_produce')) {
//    /**
//     * Produce a amqp message.
//     */
//    function amqp_produce(ProducerMessageInterface $message): bool
//    {
//        return di()->get(Producer::class)->produce($message, true);
//    }
//}