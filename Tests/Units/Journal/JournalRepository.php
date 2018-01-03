<?php
namespace LibertAPI\Tests\Units\Journal;

use \LibertAPI\Journal\JournalRepository as _Repository;

/**
 * Classe de test du repository de journal
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.5
 */
final class JournalRepository extends \Atoum
{
    /**
     * @var \LibertAPI\Journal\JournalDao Mock du DAO associé
     */
    private $dao;

    /**
     * @var \LibertAPI\Journal\JournalEntite Entité associée
     */
    private $entite;

    public function beforeTestMethod($method)
    {
        parent::beforeTestMethod($method);
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->dao = new \mock\LibertAPI\Journal\JournalDao();
        $this->entite = new \LibertAPI\Journal\JournalEntite([
            'id' => 42,
            'numeroPeriode' => 88,
            'utilisateurActeur' => '4',
            'utilisateurObjet' => '8',
            'etat' => 'cassé',
            'commentaire' => 'c\'est cassé',
            'date' => 'now',
        ]);
    }

    /*************************************************
     * GET
     *************************************************/

    /**
     * Teste la méthode getOne
     */
    public function testGetOne()
    {
        $this->calling($this->dao)->getById = [];
        $this->newTestedInstance($this->dao);

        $this->exception(function () {
            $this->testedInstance->getOne(99);
        })->isInstanceOf(\RuntimeException::class);
    }

    /**
     * Teste la méthode getList avec des critères non pertinents
     */
    public function testGetListNotFound()
    {
        $this->calling($this->dao)->getList = [];
        $this->newTestedInstance($this->dao);

        $this->exception(function () {
            $this->testedInstance->getList([]);
        })->isInstanceOf(\UnexpectedValueException::class);
    }

    /**
     * Teste la méthode getList avec des critères pertinents
     */
    public function testGetListFound()
    {
        $this->calling($this->dao)->getList = [[
            'log_id' => '42',
            'log_p_num' => 73,
            'log_user_login_par' => 'tintin',
            'log_user_login_pour' => 'milou',
            'log_etat' => 'haddock',
            'log_comment' => 'moulinsart',
            'log_date' => '43',
        ]];
        $this->newTestedInstance($this->dao);

        $entites = $this->testedInstance->getList([]);

        $this->array($entites)->hasKey(42);
        $this->object($entites[42])->isInstanceOf(\LibertAPI\Tools\Libraries\AEntite::class);
    }

    /*************************************************
     * POST
     *************************************************/

    /**
     * Teste la méthode postOne
     */
    public function testPostOne()
    {
        $this->newTestedInstance($this->dao);

        $this->exception(function () {
            $this->testedInstance->postOne([], $this->entite);
        })->isInstanceOf(\RuntimeException::class);
    }

    /*************************************************
     * PUT
     *************************************************/

    /**
     * Teste la méthode putOne
     */
    public function testPutOne()
    {
        $this->newTestedInstance($this->dao);

        $this->exception(function () {
            $this->testedInstance->putOne([], $this->entite);
        })->isInstanceOf(\RuntimeException::class);
    }

    /*************************************************
     * DELETE
     *************************************************/

    /**
     * Teste la méthode deleteOne
     */
    public function testDeleteOne()
    {
        $this->newTestedInstance($this->dao);

        $this->exception(function () {
            $this->testedInstance->deleteOne($this->entite);
        })->isInstanceOf(\RuntimeException::class);
    }
}
