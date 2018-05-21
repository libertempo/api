<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Groupe\Employe;

/**
 * Classe de test du repository d'employé de groupe
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.0
 */
final class EmployeRepository extends \LibertAPI\Tests\Units\Tools\Libraries\ARepository
{
    protected function initDao()
    {
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->dao = new \mock\LibertAPI\Groupe\Employe\EmployeDao();
    }

    protected function initEntite()
    {
        $this->entite = new \LibertAPI\Utilisateur\UtilisateurEntite([]);
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

    /**
     * @inheritDoc
     */
    protected function getEntiteContent()
    {
        return [
        ];
    }
}
