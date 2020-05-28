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

namespace App\Http\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;
use Hyperf\Validation\ValidationException;
use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    /**
     * @Inject
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;

    /**
     * @Inject
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @Inject()
     * @var ValidatorFactoryInterface
     */
    protected $validationFactory;

    public function validate(array $rules, array $message=[])
    {
        $validator = $this->validationFactory->make(
            $this ->request->all(),
            $rules,$message
        );

        if ($validator->fails()){
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}
