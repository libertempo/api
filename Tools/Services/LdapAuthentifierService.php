<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Services;

use Psr\Http\Message\ServerRequestInterface as IRequest;

/**
 *
 */
class LdapAuthentifierService extends AAuthentifierFactoryService
{
    public function isAuthentificationSucceed(IRequest $request) : bool
    {
        $authentificationType = 'Basic';
        $authentification = $request->getHeaderLine('Authorization');
        if (0 !== stripos($authentification, $authentificationType)) {
            throw new BadRequestException();
        }

        $authentification = substr($authentification, strlen($authentificationType) + 1);
        list($this->login, $password) = explode(':', base64_decode($authentification));

        $configuration = json_decode(file_get_contents(ROOT_PATH . 'configuration.json'));

        $config = [
          'hosts'    => [$configuration->ldap->serveur, $configuration->ldap->up_serveur],
          'base_dn'  => $configuration->ldap->base,
          'username' => $configuration->ldap->utilisateur,
          'password' => $configuration->ldap->mot_de_passe,
        ];

        $ldap = new \Adldap\Adldap();
        $ldap->addProvider($config);

        try {
            // TODO 2018-09-23 : Comparer le mdp aussi
            $wheres = [
                $configuration->ldap->login . '=' . $this->login,
                $configuration->ldap->domaine,
            ];

            $provider = $ldap->connect();
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
     * {@inheritDoc}
     */
    public function getLogin() : string
    {
        return $this->login;
    }

    /**
     * @var string Login de l'utilisateur en cours de connexion
     */
    private $login = '';
}
