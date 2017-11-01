<?php
namespace LibertAPI\Tests\Units\Planning;

use LibertAPI\Planning\PlanningDao as _Dao;

/**
 * Classe de test du DAO de planning
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.1
 */
final class PlanningDao extends \LibertAPI\Tests\Units\Tools\Libraries\ADao
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
        $this->calling($this->connector)->lastInsertId = 314;
        $dao = new _Dao($this->connector);

        $postId = $dao->post([
            'name' => 'name',
            'status' => 59,
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
            'name' => 'name',
            'status' => 59,
        ], 12);

        $this->variable($put)->isNull();
    }
}
