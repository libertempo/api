<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Tools\Services;

/**
 * Classe de test du service d'authentification interne
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.1
 */
class InterneAuthentifierService extends \Atoum
{
    /**
     * Init des tests
     */
    public function beforeTestMethod($method)
    {
        parent::beforeTestMethod($method);

        $this->mockGenerator->orphanize('__construct');
        $this->repository = new \mock\LibertAPI\Tools\Libraries\ARepository();
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
    }

    public function testIsAuthentificationSucceedFalse()
    {
        $entite = new \LibertAPI\Utilisateur\UtilisateurEntite([
            'id' => 42,
            'password' => md5('Fatboy slim'),
        ]);
        $this->calling($this->repository)->find = $entite;
        $this->newTestedInstance($this->repository);
        $succeed = $this->testedInstance->isAuthentificationSucceed('Aladdin', 'OpenSesame');

        $this->boolean($succeed)->isFalse();
    }

    public function testIsAuthentificationSucceedTrue()
    {
        $entite = new \LibertAPI\Utilisateur\UtilisateurEntite([
            'id' => 42,
            'password' => md5('OpenSesame'),
        ]);
        $this->calling($this->repository)->find = $entite;
        $this->newTestedInstance($this->repository);
        $succeed = $this->testedInstance->isAuthentificationSucceed('Aladdin', 'OpenSesame');

        $this->boolean($succeed)->isTrue();
    }

    /**
    * @var LibertAPI\Tools\Libraries\ARepository Mock d'un repository lambda
    */
    private $repository;
}
