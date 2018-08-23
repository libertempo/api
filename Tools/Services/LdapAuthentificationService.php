<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Services;

use Psr\Http\Message\ServerRequestInterface as IRequest;

/**
 * Classe non testable en TU (par nature de la factory, elle interdit la création externe),
 * c'est typiquement une classe à tester via Test de Service
 */
class LdapAuthentificationService extends AAuthentificationFactoryService
{
    public function isAuthentificationSucceed(IRequest $request) : bool
    {
    }
}
