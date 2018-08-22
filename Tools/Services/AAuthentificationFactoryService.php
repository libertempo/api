<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Services;

use LibertAPI\Tools\Libraries\StorageConfiguration;
use Psr\Http\Message\ServerRequestInterface as IRequest;

/**
 * Fabrique de service d'authentification. C'est elle et elle seule qui a conscience des critières de sélection de tel ou tel service. Les clients ne manipulent que des contrats.
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.1
 */
abstract class AAuthentificationFactoryService
{
    /**
     * Retourne la bonne implémentation du service d'authentification en fonction des paramètres transmis
     */
    final public static function getAuthentificationService(StorageConfiguration $configuration) : self
    {
        switch ($configuration->getHowToConnectUser()) {
            case 'ldap':
                return new LdapAuthentificationService();
            case 'db_conges':
                return new InterneAuthentificationService();
            default:
                throw new \UnexpectedValueException("Unknown Service");
        }
    }

    /**
     * Contrat standard des services d'authentification
     */
    abstract public function isAuthentificationSucceed(IRequest $request) : bool;
}
