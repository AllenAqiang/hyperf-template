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
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\JwtAuth\Jwt;
use Hyperf\Utils\Context;

/**
 * Class IndexController
 * @Controller()
 * @package App\Http\Controller
 */
class IndexController extends AbstractController
{
    /**
     * @Inject()
     * @var Jwt
     */
    protected $jwt;

    public function index()
    {
        $this ->validate([
            'access_toke' => 'required',
        ]);
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return apiSuccess([
            'method' => $method,
            'message' => "Hello {$user}.",
        ]);
    }

    /**
     * @RequestMapping(path="test", methods="get")
     */
    public function test()
    {
        $token = (string)$this ->jwt ->getToken(['id' =>2]);

        return apiSuccess($token);
    }
}
