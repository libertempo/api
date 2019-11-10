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

        switch ($ressourcePath) {
            case 'Absence|Periode':
            case 'Absence|Type':
            case 'Authentification':
            case 'Employe|Me':
            case 'Employe|Me|Heure|Repos':
            case 'Employe|Me|Heure|Additionnelle':
            case 'Employe|Me|Solde':
            case 'HelloWorld':
            case 'Journal':
            case 'Planning|Creneau':
                return $next($request, $response);
            case 'Groupe':
            case 'Groupe|Employe':
            case 'Groupe|GrandResponsable':
            case 'Groupe|Responsable':
                $user = $request->getAttribute('currentUser');
                if (!$user->isAdmin()) {
                    return call_user_func(
                        $container->get('forbiddenHandler'),
                        $request,
                        $response
                    );
                }

                return $next($request, $response);
            case 'JourFerie':
            case 'Utilisateur':
                $user = $request->getAttribute('currentUser');
                if (!$user->isHautResponsable()) {
                    return call_user_func(
                        $container->get('forbiddenHandler'),
                        $request,
                        $response
                    );
                }

                return $next($request, $response);
            case 'Planning':
                $user = $request->getAttribute('currentUser');
                if (!$user->isResponsable() && !$user->isHautResponsable() && !$user->isAdmin()) {
                    return call_user_func(
                        $container->get('forbiddenHandler'),
                        $request,
                        $response
                    );
                }

                return $next($request, $response);
            default:
                throw new \RuntimeException('Rights were not configured for the route ' . $ressourcePath);
        }
    }
}
