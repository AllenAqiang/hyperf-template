<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Exception\Handler;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ApiExceptionHandle extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    public function __construct(StdoutLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
//        $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
//        $this->logger->error($throwable->getTraceAsString());

        // 这里code默认为-1 因为layIm的api成功返回的code为0
        $code = ($throwable->getCode() == 0) ? -1 : $throwable->getCode();
        $message = $throwable->getMessage();

        // Debug is true
        if (env('APP_DEBUG')) {
            $message = sprintf('(%s) %s', get_class($throwable), $throwable->getMessage());
        }
        return throwApiException(
            $code,
            $message,
            sprintf('At %s line %d', $throwable->getFile(), $throwable->getLine()),
            $throwable->getTraceAsString()
        );
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
