<?php

declare(strict_types=1);

namespace App\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Throwable;
use Hyperf\Validation\ValidationException;

class ValidationExceptionHandler extends ExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
        /** @var \Hyperf\Validation\ValidationException $throwable */
        $body = $throwable->validator->errors()->first();

        $code = ($throwable->getCode() == 0) ? -1 : $throwable->getCode();

        return throwApiException(
            $code,
            $body
        );
//        return $response->withStatus($throwable->status)->withBody(new SwooleStream(json_encode($responseData, JSON_UNESCAPED_UNICODE)));
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof ValidationException;
    }
}
