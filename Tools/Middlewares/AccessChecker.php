<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Middlewares;

use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use \LibertAPI\Tools\Helpers\Formatter;

/**
 * Vérifie les autorisations d'accès pour la route et l'utilisateur donnés
 *
 * @since 1.1
 */
final class AccessChecker extends \LibertAPI\Tools\AMiddleware
{
    public function __invoke(IRequest $request, IResponse $response, callable $next) : IResponse
    {
        $ressourcePath = $request->getAttribute('nomRessources');
        $container = $this->getContainer();
        $openedRoutes = ['Authentification', 'HelloWorld'];
        if (in_array($ressourcePath, $openedRoutes, true)) {
            return $next($request, $response);
        }
        switch ($ressourcePath) {
            case 'Absence|Type':
                return $next($request, $response);
            case 'Groupe':
            case 'Groupe|GrandResponsable':
                if (!$container->get('currentUser')->isAdmin()) {
                    return call_user_func(
                        $container->get('forbiddenHandler'),
                        $request,
                        $response
       );
                }

                return $next($request, $response);
            default:
                ddd($ressourcePath);
        }
    }
}
