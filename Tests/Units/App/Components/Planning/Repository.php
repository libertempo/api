<?php
namespace Tests\Units\App\Components\Planning;

use \App\Components\Planning\Repository as _Repository;

/**
 * Classe de test du repository de planning
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.1
 */
final class Repository extends \Atoum
{
    /**
     * @var \mock\App\Components\Planning\Dao Mock du DAO du planning
     */
    private $dao;

    /**
     * @var \mock\App\Components\Planning\Entite Mock du Modèle de planning
     */
    private $entite;

    public function beforeTestMethod($method)
    {
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->dao = new \mock\App\Components\Planning\Dao();
        $this->mockGenerator->orphanize('__construct');
        $this->entite = new \mock\App\Components\Planning\Entite();
        $this->entite->getMockController()->getId = 42;
        $this->entite->getMockController()->getName = 12;
        $this->entite->getMockController()->getStatus = 12;
    }

    /*************************************************
     * GET
     *************************************************/

    /**
     * Teste la méthode getOne avec un id non trouvé
     */
    public function testGetOneNotFound()
    {
        $this->dao->getMockController()->getById = [];
        $repository = new _Repository($this->dao);

        $this->exception(function () use ($repository) {
            $repository->getOne(99);
        })->isInstanceOf('\DomainException');
    }

    /**
     * Teste la méthode getOne avec un id trouvé
     */
    public function testGetOneFound()
    {
        $this->dao->getMockController()->getById = [
            'planning_id' => '42',
            'name' => 'H2G2',
            'status' => '8',
        ];
        $repository = new _Repository($this->dao);

        $entite = $repository->getOne(42);

        $this->object($entite)->isInstanceOf('\App\Libraries\AEntite');
        $this->integer($entite->getId())->isIdenticalTo(42);
    }

    /**
     * Teste la méthode getList avec des critères non pertinents
     */
    public function testGetListNotFound()
    {
        $this->dao->getMockController()->getList = [];
        $repository = new _Repository($this->dao);

        $this->exception(function () use ($repository) {
            $repository->getList([]);
        })->isInstanceOf('\UnexpectedValueException');
    }

    /**
     * Teste la méthode getList avec des critères pertinents
     */
    public function testGetListFound()
    {
        $this->dao->getMockController()->getList = [[
            'planning_id' => '42',
            'name' => 'H2G2',
            'status' => '8',
        ]];
        $repository = new _Repository($this->dao);

        $entites = $repository->getList([]);

        $this->array($entites)->hasKey(42);
        $this->object($entites[42])->isInstanceOf('\App\Libraries\AEntite');
    }

    /*************************************************
     * POST
     *************************************************/

    /**
     * Teste la méthode postOne avec un champ manquant
     */
    public function testPostOneMissingArg()
    {
        $repository = new _Repository($this->dao);

        $this->exception(function () use ($repository) {
            $repository->postOne(['name' => 'bob'], new \mock\App\Components\Planning\Entite([]));
        })->isInstanceOf('\App\Exceptions\MissingArgumentException');
    }

    /**
     * Teste la méthode postOne avec un champ incohérent
     */
    public function testPostOneBadDomain()
    {
        $repository = new _Repository($this->dao);
        $entite = new \mock\App\Components\Planning\Entite([]);
        $entite->getMockController()->populate = function () {
            throw new \DomainException('');
        };

        $this->exception(function () use ($repository, $entite) {
            $repository->postOne(['name' => 'bob', 'status' => 'bab'], $entite);
        })->isInstanceOf('\DomainException');
    }

    /**
     * Teste la méthode postOne quand tout est ok
     */
    public function testPostOneOk()
    {
        $repository = new _Repository($this->dao);
        $entite = new \mock\App\Components\Planning\Entite([]);
        $entite->getMockController()->populate = '';
        $entite->getMockController()->getName = 'name';
        $entite->getMockController()->getStatus = 'status';
        $this->dao->getMockController()->post = 3;

        $post = $repository->postOne(['name' => 'bob', 'status' => 'pop'], $entite);

        $this->integer($post);
    }

    /*************************************************
     * PUT
     *************************************************/

    /**
     * Teste la méthode putOne avec un champ manquant
     */
    public function testPutOneMissingArgument()
    {
        $repository = new _Repository($this->dao);

        $this->exception(function () use ($repository) {
            $repository->putOne(['name' => 'bob'], new \mock\App\Components\Planning\Entite([]));
        })->isInstanceOf('\App\Exceptions\MissingArgumentException');
    }

    /**
     * Teste la méthode putOne avec un champ incohérent
     */
    public function testPutOneBadDomain()
    {
        $repository = new _Repository($this->dao);
        $entite = new \mock\App\Components\Planning\Entite([]);
        $entite->getMockController()->populate = function () {
            throw new \DomainException('');
        };

        $this->exception(function () use ($repository, $entite) {
            $repository->putOne(['name' => 'bob', 'status' => 'bab'], $entite);
        })->isInstanceOf('\DomainException');
    }

    /**
     * Teste la méthode putOne tout ok
     */
    public function testPutOneOk()
    {
        $repository = new _Repository($this->dao);

        $result = $repository->putOne(['name' => 'baba', 'status' => 4], $this->entite);

        $this->variable($result)->isNull();
    }

    /*************************************************
     * DELETE
     *************************************************/

    /**
     * Teste le fallback de la méthode deleteOne
     */
    public function testDeleteFallback()
    {
        $this->dao->getMockController()->delete = function () {
            throw new \LogicException('');
        };
        $repository = new _Repository($this->dao);

        $this->exception(function () use ($repository) {
            $repository->deleteOne(new \mock\App\Components\Planning\Entite([]));
        })->isInstanceOf('\LogicException');

    }

    /**
     * Teste la méthode deleteOne tout ok
     */
    public function testDeleteOk()
    {
        $this->dao->getMockController()->delete = 4;
        $repository = new _Repository($this->dao);
        $entite = new \mock\App\Components\Planning\Entite([]);

        $this->variable($repository->deleteOne($entite))->isNull();
    }
}
