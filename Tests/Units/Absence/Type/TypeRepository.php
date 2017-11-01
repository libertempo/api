<?php
namespace LibertAPI\Tests\Units\Absence\Type;

/**
 * Classe de test du repository de planning
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.5
 */
final class TypeRepository extends \Atoum
{
    /**
     * @var \LibertAPI\Absence\Type\TypeDao Mock du DAO du planning
     */
    private $dao;

    /**
     * @var \LibertAPI\Absence\Type\TypeEntite Mock de l'Entité de planning
     */
    private $entite;

    public function beforeTestMethod($method)
    {
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->dao = new \mock\LibertAPI\Absence\Type\TypeDao();
        $this->mockGenerator->orphanize('__construct');
        $this->entite = new \LibertAPI\Absence\Type\TypeEntite([
            'id' => 42,
            'type' => 'thieft',
            'libelle' => 'GTA',
            'libelleCourt' => 'vice'
        ]);
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
        $this->newTestedInstance($this->dao);
        $this->exception(function () {
            $this->testedInstance->getOne(99);
        })->isInstanceOf('\DomainException');
    }

    /**
     * Teste la méthode getOne avec un id trouvé
     */
    public function testGetOneFound()
    {
        $this->dao->getMockController()->getById = [
            'ta_id' => 42,
            'ta_type' => 'aventure',
            'ta_libelle' => 'AS',
            'ta_short_libelle' => 'creed',
        ];
        $this->newTestedInstance($this->dao);
        $entite = $this->testedInstance->getOne(42);

        $this->object($entite)->isInstanceOf('\LibertAPI\Tools\Libraries\AEntite');
        $this->integer($entite->getId())->isIdenticalTo(42);
    }

    /**
     * Teste la méthode getList avec des critères non pertinents
     */
    public function testGetListNotFound()
    {
        $this->dao->getMockController()->getList = [];
        $this->newTestedInstance($this->dao);

        $this->exception(function () {
            $this->testedInstance->getList([]);
        })->isInstanceOf('\UnexpectedValueException');
    }

    /**
     * Teste la méthode getList avec des critères pertinents
     */
    public function testGetListFound()
    {
        $this->dao->getMockController()->getList = [[
            'ta_id' => 42,
            'ta_type' => 'aventure',
            'ta_libelle' => 'AS',
            'ta_short_libelle' => 'creed',
        ]];
        $this->newTestedInstance($this->dao);
        $entites = $this->testedInstance->getList([]);

        $this->array($entites)->hasKey(42);
        $this->object($entites[42])->isInstanceOf('\LibertAPI\Tools\Libraries\AEntite');
    }

    /*************************************************
     * POST
     *************************************************/

    /**
     * Teste la méthode postOne avec un champ manquant
     */
    public function testPostOneMissingArg()
    {
        $this->newTestedInstance($this->dao);

        $this->exception(function () {
            $this->testedInstance->postOne(['name' => 'bob'], new \LibertAPI\Absence\Type\TypeEntite([]));
        })->isInstanceOf('\LibertAPI\Tools\Exceptions\MissingArgumentException');
    }

    /**
     * Teste la méthode postOne avec un champ incohérent
     */
    public function testPostOneBadDomain()
    {
        $this->newTestedInstance($this->dao);
        $entite = new \LibertAPI\Absence\Type\TypeEntite([]);

        $this->exception(function () use ($entite) {
            $this->testedInstance->postOne(['type' => '', 'libelle' => 'Roger', 'libelleCourt' => 'Maverick'], $entite);
        })->isInstanceOf('\DomainException');
    }

    /**
     * Teste la méthode postOne quand tout est ok
     */
    public function testPostOneOk()
    {
        $this->dao->getMockController()->post = 3;
        $this->newTestedInstance($this->dao);

        $post = $this->testedInstance->postOne(['type' => 'Holly', 'libelle' => 'Roger', 'libelleCourt' => 'Maverick'], $this->entite);

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
        $this->newTestedInstance($this->dao);

        $this->exception(function () {
            $this->testedInstance->putOne(['libelle' => 'Roger', 'libelleCourt' => 'Maverick'], new \LibertAPI\Absence\Type\TypeEntite([]));
        })->isInstanceOf('\LibertAPI\Tools\Exceptions\MissingArgumentException');
    }

    /**
     * Teste la méthode putOne avec un champ incohérent
     */
    public function testPutOneBadDomain()
    {
        $this->newTestedInstance($this->dao);
        $entite = new \LibertAPI\Absence\Type\TypeEntite([]);

        $this->exception(function () use ($entite) {
            $this->testedInstance->putOne(['type' => '', 'libelle' => 'Roger', 'libelleCourt' => 'Maverick'], $entite);
        })->isInstanceOf('\DomainException');
    }

    /**
     * Teste la méthode putOne tout ok
     */
    public function testPutOneOk()
    {
        $this->newTestedInstance($this->dao);

        $result = $this->testedInstance->putOne(['type' => 'Holly', 'libelle' => 'Roger', 'libelleCourt' => 'Maverick'], $this->entite);

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
        $this->newTestedInstance($this->dao);

        $this->exception(function () {
            $this->testedInstance->deleteOne(new \LibertAPI\Absence\Type\TypeEntite([]));
        })->isInstanceOf('\LogicException');

    }

    /**
     * Teste la méthode deleteOne tout ok
     */
    public function testDeleteOk()
    {
        $this->dao->getMockController()->delete = 4;
        $this->newTestedInstance($this->dao);
        $entite = new \LibertAPI\Absence\Type\TypeEntite([]);

        $this->variable($this->testedInstance->deleteOne($entite))->isNull();
    }
}
