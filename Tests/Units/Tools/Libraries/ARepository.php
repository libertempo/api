<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Tools\Libraries;

use LibertAPI\Tools\Libraries\AEntite;

/**
 * Classe de test des repositories
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.6
 */
abstract class ARepository extends \Atoum
{
    public function beforeTestMethod($method)
    {
        parent::beforeTestMethod($method);
        $this->initDao();
        $this->initEntite();
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->result = new \mock\Doctrine\DBAL\Statement();
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->queryBuilder = new \mock\Doctrine\DBAL\Query\QueryBuilder();
        $this->calling($this->queryBuilder)->execute = $this->result;
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->connector = new \mock\Doctrine\DBAL\Connection();
        $this->calling($this->connector)->createQueryBuilder = $this->queryBuilder;
    }

    abstract protected function initDao();

    abstract protected function initEntite();

    /**
     * @var \LibertAPI\Tools\Libraries\ADao
     */
    protected $dao;

    /**
     * @var \LibertAPI\Tools\Libraries\AEntite
     */
    protected $entite;

    /**
     * @var \Doctrine\DBAL\Connection Mock du connecteur
     */
    protected $connector;

    /**
     * @var \Doctrine\DBAL\Query\QueryBuilder Mock du queryBuilder
     */
    protected $queryBuilder;

    /**
     * @var \Doctrine\DBAL\Statement Curseur de résultats
     */
    protected $result;

    /*************************************************
     * GET
     *************************************************/

    /**
     * Teste la méthode getOne
     */
    public function testGetOne()
    {
        $this->dao->getMockController()->getById = $this->entite;
        $this->newTestedInstance($this->dao, $this->connector);

        $entite = $this->testedInstance->getOne(42);

        $this->object($entite)->isInstanceOf(AEntite::class);
    }

    /**
     * Teste la méthode getList
     */
    public function testGetList()
    {
        $this->calling($this->dao)->getList = [42 => $this->entite];
        $this->newTestedInstance($this->dao, $this->connector);

        $entites = $this->testedInstance->getList([]);

        $this->array($entites)->hasKey(42);
        $this->object($entites[42]);
    }

    /**
     * Teste la méthode postOne
     */
    public function testPostOne()
    {
        $this->newTestedInstance($this->dao, $this->connector);
        $this->calling($this->dao)->post = 768;

        $post = $this->testedInstance->postOne($this->getEntiteContent(), $this->entite);

        $this->integer($post)->isIdenticalTo(768);
    }

    /**
     * Teste la méthode putOne
     */
    public function testPutOne()
    {
        $this->newTestedInstance($this->dao, $this->connector);

        $put = $this->testedInstance->putOne($this->getEntiteContent(), $this->entite);

        $this->variable($put)->isNull();
    }

    abstract protected function getEntiteContent();
}
