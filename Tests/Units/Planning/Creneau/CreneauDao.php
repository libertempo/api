<?php
namespace LibertAPI\Tests\Units\Planning\Creneau;

use \LibertAPI\Planning\Creneau\CreneauDao as _Dao;

/**
 * Classe de test du DAO de créneau de planning
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.1
 */
final class CreneauDao extends \LibertAPI\Tests\Units\Tools\Libraries\ADao
{
    /*************************************************
     * GET
     *************************************************/


    /*************************************************
     * POST
     *************************************************/

    /**
     * Teste la méthode post quand tout est ok
     */
    public function testPostOk()
    {
        $this->connector->getMockController()->lastInsertId = 314;
        $dao = new _Dao($this->connector);

        $postId = $dao->post([
            'planning_id' => 12,
            'jour_id' => 7,
            'type_semaine' => 23,
            'type_periode' => 2,
            'debut' => 63,
            'fin' => 55,
        ]);

        $this->integer($postId)->isIdenticalTo(314);
    }

    /*************************************************
     * PUT
     *************************************************/

    /**
     * Teste la méthode put quand tout est ok
     */
    public function testPutOk()
    {
        $dao = new _Dao($this->connector);

        $put = $dao->put([
            'planning_id' => 83,
            'jour_id' => 27,
            'type_semaine' => 2,
            'type_periode' => 52,
            'debut' => 31,
            'fin' => 91,
        ], 22);

        $this->variable($put)->isNull();
    }

    /**
     * Teste la méthode delete quand tout est ok
     */
    public function testDeleteOk()
    {
        $this->calling($this->result)->rowCount = 1;
        $this->newTestedInstance($this->connector);

        $res = $this->testedInstance->delete(7);

        $this->variable($res)->isNull();
    }
}
