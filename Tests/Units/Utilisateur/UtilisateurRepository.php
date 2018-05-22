<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Utilisateur;

use LibertAPI\Tools\Libraries\AEntite;

/**
 * Classe de test du repository de l'utilisateur
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 */
final class UtilisateurRepository extends \LibertAPI\Tests\Units\Tools\Libraries\ARepository
{
    /**
     * @var \LibertAPI\Tools\Libraries\Application Mock de la bibliothèque d'application
     */
    private $application;

    /**
     * @var \Doctrine\DBAL\Connection Mock du connecteur
     */
    protected $connector;

    /**
     * @var \Doctrine\DBAL\Statement Mock du curseur de résultat
     */
    private $statement;

    public function beforeTestMethod($method)
    {
        parent::beforeTestMethod($method);

        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->statement = new \mock\Doctrine\DBAL\Statement();
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->connector = new \mock\Doctrine\DBAL\Connection();
        $this->connector->getMockController()->query = $this->statement;
        $this->mockGenerator->orphanize('__construct');
        $this->application = new \mock\LibertAPI\Tools\Libraries\Application($this->connector);

    }

    protected function initDao()
    {
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->dao = new \mock\LibertAPI\Utilisateur\UtilisateurDao();
    }

    protected function initEntite()
    {
        $this->mockGenerator->orphanize('__construct');
        $this->entite = new \mock\LibertAPI\Utilisateur\UtilisateurEntite();
        $this->entite->getMockController()->getNom = 'Aladdin';
        $this->entite->getMockController()->getDateInscription = '222';
    }

    /**
     * Teste la méthode setApplication exécutée une fois
     */
    public function testSetApplicationOnce()
    {
        $this->newTestedInstance($this->dao, $this->connector);

        $this->variable($this->testedInstance->setApplication($this->application))->isNull();
    }

    /**
     * Teste la méthode setApplication exécutée deux fois
     */
    public function testSetApplicationTwice()
    {
        $this->newTestedInstance($this->dao, $this->connector);

        $this->exception(function () {
            $this->testedInstance->setApplication($this->application);
            $application2 = new \mock\LibertAPI\Tools\Libraries\Application($this->connector);
            $this->testedInstance->setApplication($application2);
            $this->testedInstance->getList([]);
        })->isInstanceOf('\LogicException');
    }

    /*************************************************
     * GET
     *************************************************/

    /**
     * Teste la méthode find avec des critères pertinents
     */
    public function testFind()
    {
        $this->calling($this->dao)->getList = ['Aladdin' => new \LibertAPI\Utilisateur\UtilisateurEntite([
            'id' => 'Aladdin',
            'u_login' => 'Aladdin',
            'u_passwd' => 'OpenSesame',
            'u_nom' => 'Aladdin',
            'u_prenom' => 'Aladdin',
            'u_is_resp' => 'Y',
            'u_is_admin' => 'N',
            'u_is_hr' => 'N',
            'u_is_active' => 'N',
            'u_quotite' => 1000,
            'u_email' => 'aladdin@tapisvolant.net',
            'u_num_exercice' => 98,
            'planning_id' => 12,
            'u_heure_solde' => 983,
            'date_inscription' => 2,
            'token' => '',
            'date_last_access' => 3,
        ]),
        'Sinbad' => new \LibertAPI\Utilisateur\UtilisateurEntite([
            'id' => 'Sinbad',
            'u_login' => 'Sinbad',
            'u_nom' => 'Sinbad',
            'u_prenom' => 'Sinbad',
            'u_is_resp' => 'N',
            'u_is_admin' => 'N',
            'u_is_hr' => 'N',
            'u_is_active' => 'N',
            'u_passwd' => 'Bassorah',
            'u_quotite' => 1000,
            'u_email' => 'sinbad@sea.com',
            'u_num_exercice' => 5,
            'planning_id' => 12,
            'u_heure_solde' => 1218,
            'date_inscription' => 2,
            'token' => '',
            'date_last_access' => 134,
        ]),];
        $this->newTestedInstance($this->dao, $this->connector);

        $entite = $this->testedInstance->find([]);

        $this->object($entite)->isInstanceOf(\LibertAPI\Tools\Libraries\AEntite::class);
    }

    /*************************************************
     * POST
     *************************************************/


    public function testPostOne()
    {
        $this->exception(function () {
            $this->newTestedInstance($this->dao, $this->connector);
            $this->testedInstance->postOne([], $this->entite);
        });
    }

    /*************************************************
     * PUT
     *************************************************/

    public function testUpdateDateLastAccess()
    {
        $this->newTestedInstance($this->dao, $this->connector);
        $this->entite->getMockController()->getToken = 'Tartuffe';

        $this->testedInstance->updateDateLastAccess($this->entite);

        $this->mock($this->entite)->call('updateDateLastAccess')->once();
        $this->mock($this->dao)->call('put')->once();

    }

    /**
     * Teste la méthode generateToken avec un token d'instance vide
     */
    public function testRegenerateTokenWithTokenInstanceEmpty()
    {
        $this->newTestedInstance($this->dao, $this->connector);
        $this->application->getMockController()->getTokenInstance = '';
        $this->testedInstance->setApplication($this->application);

        $this->exception(function () {
            $this->testedInstance->regenerateToken($this->entite);
        })->isInstanceOf('\RuntimeException');
    }

    /**
     * Teste la méthode generateToken avec un token incohérent
     */
    public function testRegenerateTokenBadDomain()
    {
        $this->newTestedInstance($this->dao, $this->connector);
        $this->application->getMockController()->getTokenInstance = 'vi veri veniversum vivus vici';
        $this->testedInstance->setApplication($this->application);
        $this->entite->getMockController()->populateToken = function () {
            throw new \DomainException('');
        };

        $this->exception(function () {
            $this->testedInstance->regenerateToken($this->entite);
        })->isInstanceOf('\DomainException');
    }

    public function testRegenerateTokenOk()
    {
        $this->newTestedInstance($this->dao, $this->connector);
        $this->application->getMockController()->getTokenInstance = 'vi veri veniversum vivus vici';
        $this->testedInstance->setApplication($this->application);
        $this->entite->getMockController()->populateToken = '';
        $this->entite->getMockController()->getToken = 'Pedro l\'asticot';
        $this->dao->getMockController()->put = '';

        $entite = $this->testedInstance->regenerateToken($this->entite);

        $this->object($entite)->isInstanceOf(AEntite::class);
    }

    /*************************************************
     * DELETE
     *************************************************/

    public function testDeleteOne()
    {
        $this->newTestedInstance($this->dao, $this->connector);

        $this->variable($this->testedInstance->deleteOne($this->entite))->isNull();
    }

    protected function getEntiteContent()
    {
        return [
        ];
    }
}
