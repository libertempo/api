<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Services;

use \Adldap\AdldapInterface;
use Psr\Http\Message\ServerRequestInterface as IRequest;

/**
 * Service d'authentication via un serveur LDAP
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

    public function isAuthentificationSucceed(IRequest $request) : bool
    {
        $this->storeBasicIdentificants($request);
        // @TODO 2018-09-30 : Factoriser
        $configuration = json_decode(file_get_contents(ROOT_PATH . 'configuration.json'));

        $config = [
          'hosts'    => [$configuration->ldap->serveur, $configuration->ldap->up_serveur],
          'base_dn'  => $configuration->ldap->base,
          'username' => $configuration->ldap->utilisateur,
          'password' => $configuration->ldap->mot_de_passe,
        ];

        $this->ldap->addProvider($config);

        try {
            $wheres = [
                $configuration->ldap->login . '=' . $this->getLogin(),
                $configuration->ldap->domaine,
            ];
            $provider = $this->ldap->connect();
            $result = $provider->search()->findByDnOrFail(implode(',', $wheres));

            return $this->getPassword() === $result->getFirstAttribute('userpassword');
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
