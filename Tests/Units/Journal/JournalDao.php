<?php
namespace LibertAPI\Tests\Units\Journal;

/**
 * Classe de test du DAO de planning
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.5
 */
final class JournalDao extends \LibertAPI\Tests\Units\Tools\Libraries\ADao
{
    /*************************************************
     * GET
     *************************************************/

    /**
     * Teste la méthode getById
     */
    public function testGetById()
    {
        $this->newTestedInstance($this->connector);

        $this->exception(function () {
            $this->testedInstance->delete([]);
        })->isInstanceOf(\RuntimeException::class);
    }

    /**
     * Teste la méthode getList avec des critères non pertinents
     */
    public function testGetListNotFound()
    {
        $this->calling($this->result)->fetchAll = [];
        $dao = $this->newTestedInstance($this->connector);

        $get = $dao->getList([]);

        $this->array($get)->isEmpty();
    }

    /**
     * Teste la méthode getList avec des critères pertinents
     */
    public function testGetListFound()
    {
        $this->calling($this->result)->fetchAll = [['a']];
        $dao = $this->newTestedInstance($this->connector);

        $get = $dao->getList([]);

        $this->array($get[0])->isNotEmpty();
    }

    /*************************************************
     * POST
     *************************************************/

    /**
     * Teste la méthode post quand tout est ok
     */
    public function testPostOk()
    {
        $this->newTestedInstance($this->connector);

        $this->exception(function () {
            $this->testedInstance->delete([]);
        })->isInstanceOf(\RuntimeException::class);
    }

    /*************************************************
     * PUT
     *************************************************/

    /**
     * Teste la méthode put quand tout est ok
     */
    public function testPutOk()
    {
        $this->newTestedInstance($this->connector);

        $this->exception(function () {
            $this->testedInstance->delete([]);
        })->isInstanceOf(\RuntimeException::class);
    }

    /*************************************************
     * DELETE
     *************************************************/

    /**
     * Teste la méthode delete
     */
    public function testDeleteOk()
    {
        $this->newTestedInstance($this->connector);

        $this->exception(function () {
            $this->testedInstance->delete([]);
        })->isInstanceOf(\RuntimeException::class);
    }
}
