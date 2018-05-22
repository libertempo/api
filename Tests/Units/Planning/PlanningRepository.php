<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Planning;

/**
 * Classe de test du repository de planning
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.1
 */
final class PlanningRepository extends \LibertAPI\Tests\Units\Tools\Libraries\ARepository
{
    protected function initDao()
    {
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->dao = new \mock\LibertAPI\Planning\PlanningDao();
    }

    protected function initEntite()
    {
        $this->entite = new \LibertAPI\Planning\PlanningEntite(['id' => 42]);
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
        $this->newTestedInstance($this->dao, $this->connector);

        $this->exception(function () {
            $this->testedInstance->deleteOne($this->entite);
        })->isInstanceOf('\LogicException');
    }

    /**
     * Teste la méthode deleteOne tout ok
     */
    public function testDeleteOk()
    {
        $this->dao->getMockController()->delete = 4;
        $this->newTestedInstance($this->dao, $this->connector);

        $this->variable($this->testedInstance->deleteOne($this->entite))->isNull();
    }

    protected function getEntiteContent()
    {
        return [
            'id' => 72,
            'name' => 'name',
            'status' => 59,
        ];
    }
}
