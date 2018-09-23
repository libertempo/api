<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Services;

use LibertAPI\Tools\Libraries\ARepository;
use LibertAPI\Tools\Libraries\StorageConfiguration;

/**
 * Fabrique de service d'authentification. C'est elle et elle seule qui a conscience des critières de sélection de tel ou tel service.
 * Les clients ne manipulent que des contrats.
 *
 * À ce jour, je ne passe que user/password. Pour CAS et SSO il faudra passer la requête
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.1
 */
abstract class AAuthentifierFactoryService
{
    /**
     * Retourne la bonne implémentation du service d'authentification en fonction des paramètres transmis
     */
    final public static function getAuthentifier(StorageConfiguration $configuration, ARepository $repository, string $login) : self
    {
        $authentifier = $configuration->getHowToConnectUser();
        if (self::isAdmin($login) || 'dbconges' === $authentifier) {
            return new InterneAuthentifierService($repository);
        }
        switch ($authentifier) {
            case 'ldap':
                return new LdapAuthentifierService(new \Adldap\Adldap());
            default:
                throw new \UnexpectedValueException("Unknown Service");
        }
    }

    private static function isAdmin(string $login) : bool
    {
        return 'admin' === $login;
    }

    /**
     * Contrat standard des services d'authentification
     * @return true si l'authentification s'est bien déroulée
     * @throws BadRequestException Si la requête n'est pas bien formée
     */
    abstract public function isAuthentificationSucceed(string $login, string $password) : bool;
}
