<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Services;

use \Adldap\AdldapInterface;

/**
 * Servuce d'authentication via un serveur LDAP
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.3
 */
class LdapAuthentifierService extends AAuthentifierFactoryService
{
    public function __construct(AdldapInterface $ldap)
    {
        $this->ldap = $ldap;
    }

    public function isAuthentificationSucceed(string $login, string $password) : bool
    {
        $configuration = json_decode(file_get_contents(ROOT_PATH . 'configuration.json'));

        $config = [
          'hosts'    => [$configuration->ldap->serveur, $configuration->ldap->up_serveur],
          'base_dn'  => $configuration->ldap->base,
          'username' => $configuration->ldap->utilisateur,
          'password' => $configuration->ldap->mot_de_passe,
        ];

        $this->ldap->addProvider($config);

        try {
            // TODO 2018-09-23 : Comparer le mdp aussi
            $wheres = [
                $configuration->ldap->login . '=' . $login,
                $configuration->ldap->domaine,
            ];

            $provider = $this->ldap->connect();
            $provider->search()->findByDnOrFail(implode(',', $wheres));

            // Retourne true obligatoirement. En effet, si on arrive là, c'est qu'il ne s'est produit aucun cas d'échec
            return true;
        } catch (\Adldap\Auth\BindException $e) {
            return false;
        } catch (\Adldap\Models\ModelNotFoundException $e) {
            return false;
        }
    }

    /**
     * @var AdldapInterface Service LDAP
     */
    private $ldap;
}
