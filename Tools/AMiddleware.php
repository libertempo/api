<?php declare(strict_types = 1);
namespace LibertAPI\Tools;

use \Slim\App as App;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;

/**
 * @since 1.0
 */
abstract class AMiddleware
{
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    private $app;

    protected function getApp()
    {
        return $this->app;
    }

    abstract public function __invoke(IRequest $request, IResponse $response, callable $next) : IResponse;
}
