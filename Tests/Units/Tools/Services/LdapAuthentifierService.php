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
        $this->calling($this->provider)->search = $this->search;
        $this->function->file_get_contents = '';
        $this->function->json_decode = (object) $this->configuration;
    }

    public function testIsAuthentificationSucceedBindException()
    {
        $this->calling($this->ldap)->connect = function () {
            throw new \Adldap\Auth\BindException('');
        };
        $this->newTestedInstance($this->ldap);
        $succeed = $this->testedInstance->isAuthentificationSucceed('Aladdin', 'OpenSesame');

        $this->boolean($succeed)->isFalse();
    }

    public function testIsAuthentificationSucceedModelNotFoundException()
    {
        $this->calling($this->search)->findByDnOrFail = function () {
            throw new \Adldap\Models\ModelNotFoundException('');
        };
        $this->newTestedInstance($this->ldap);
        $succeed = $this->testedInstance->isAuthentificationSucceed('Aladdin', 'OpenSesame');

        $this->boolean($succeed)->isFalse();
    }

    public function testIsAuthentificationSucceedTrue()
    {
        $this->mockGenerator->orphanize('__construct');
        $model = new \mock\Adldap\Models\Entry();
        $model->userpassword = 'OpenSesame';
        $this->calling($this->search)->findByDnOrFail = $model;
        $this->newTestedInstance($this->ldap);
        $succeed = $this->testedInstance->isAuthentificationSucceed('Aladdin', 'OpenSesame');

        $this->boolean($succeed)->isTrue();
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
}
