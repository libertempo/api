<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Tools\Services;

/**
 * Classe de test du service d'authentification via LDAP
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.3
 */
class LdapAuthentifierService extends \Atoum
{
    /**
     * Init des tests
     */
    public function beforeTestMethod($method)
    {
        parent::beforeTestMethod($method);

        $this->mockGenerator->orphanize('__construct');
        $this->search = new \mock\Adldap\Query\Factory();
        $this->provider = new \mock\Adldap\Connections\Provider();
        $this->ldap = new \mock\Adldap\Adldap();
        $this->calling($this->ldap)->addProvider = '';
        $this->calling($this->ldap)->connect = $this->provider;
        $this->calling($this->search)->select = null;
        $this->calling($this->search)->users = $this->users();
        $this->calling($this->provider)->search = $this->search;
        $this->mockGenerator->orphanize('__construct');
        $this->guard = new \mock\Adldap\Auth\Guard();
        $this->calling($this->provider)->auth = $this->guard; 
        $this->mockGenerator->orphanize('__construct');
        $this->request = new \mock\Slim\Http\Request();
        $configuration = json_decode(json_encode($this->configuration));
        $this->calling($this->request)->getAttribute = $configuration;
        $this->calling($this->request)->getHeaderLine = 'Basic QWxhZGRpbjpPcGVuU2VzYW1l';
    }

    public function testIsAuthentificationSucceedFalse()
    {
        $this->calling($this->guard)->attempt = false;
        $this->newTestedInstance($this->ldap);
        $succeed = $this->testedInstance->isAuthentificationSucceed($this->request);

        $this->boolean($succeed)->isFalse();
    }

    public function testIsAuthentificationSucceedTrue()
    {
        $this->calling($this->guard)->attempt = true;
        $this->newTestedInstance($this->ldap);
        $succeed = $this->testedInstance->isAuthentificationSucceed($this->request);

        $this->boolean($succeed)->isTrue();
    }

    private function users()
    {
        return new class($this) {
            private $outer;
            public function __construct($outer) {$this->outer = $outer;}
             public function where() {
                return $this->outer->first();
            }
        };
    }
 
    public function first()
    {
        return new class($this) {
            private $outer;
            public function __construct($outer) {$this->outer = $outer;}
            public function firstOrFail() {
                return $this->outer->user();
            }
        };
    }
 
    public function user()
    {
        return new class {
            public function getDn() {}
            public function getPassword() {}
        };
    }

    /**
    * @var \Adldap\AdldapInterface Mock du service LDAP
    */
    private $ldap;

    /**
     * @var \Adldap\Connections\ProviderInterface
     */
    private $provider;

    /**
     * @var \Adldap\Query\Factory
     */
    private $search;

    /**
     * @var \Adldap\Auth\Guard
     */
    private $guard;

    /**
     * @var array
     */
    private $configuration = [
        'ldap' => [
            'serveur' => '',
            'up_serveur' => '',
            'base' => '',
            'utilisateur' => '',
            'mot_de_passe' => '',
            'login' => '',
            'domaine' => '',
        ],
    ];

    /**
     * @var \Slim\Http\Request Mock de la requête HTTP
     */
    protected $request;
}
