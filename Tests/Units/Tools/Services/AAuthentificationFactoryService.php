<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Tools\Services;

use LibertAPI\Tools\Services;

/**
 * Classe de test de la fabrique de services d'authentification
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.1
 */
class AAuthentificationFactoryService extends \Atoum
{
    public function beforeTestMethod($method)
    {
        parent::beforeTestMethod($method);

        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->configuration = new \mock\LibertAPI\Tools\Libraries\StorageConfiguration();
    }

    public function testGetLdapService()
    {
        $this->calling($this->configuration)->getHowToConnectUser = 'ldap';

        $testedClass = $this->testedClass->getClass();
        $service = $testedClass::getAuthentificationService($this->configuration);
        $this->object($service)->isInstanceOf(Services\LdapAuthentificationService::class);
    }

    public function testGetInterneService()
    {
        $this->calling($this->configuration)->getHowToConnectUser = 'db_conges';

        $testedClass = $this->testedClass->getClass();
        $service = $testedClass::getAuthentificationService($this->configuration);
        $this->object($service)->isInstanceOf(Services\InterneAuthentificationService::class);
    }

    public function testGetUnknownService()
    {
        $this->calling($this->configuration)->getHowToConnectUser = 'foobar';

        $this->exception(function () {
            $testedClass = $this->testedClass->getClass();
            $service = $testedClass::getAuthentificationService($this->configuration);
        })->isInstanceOf(\UnexpectedValueException::class);
    }

    /**
     * @var LibertAPI\Tools\Libraries\StorageConfiguration Mock de la configuration
     */
    private $configuration;
}
