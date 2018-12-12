<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Middlewares;

use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;

/**
 * Vérification des headers
 *
 * @since 1.0
 */
final class HeadersChecker extends \LibertAPI\Tools\AMiddleware
{
    public function __invoke(IRequest $request, IResponse $response, callable $next) : IResponse
    {
        if ('application/json' === $request->getHeaderLine('Accept')) {
            return $next($request, $response);
        }
        return call_user_func(
            $this->getContainer()->get('badRequestHandler'),
            $request,
            $response
        );
    }
}
