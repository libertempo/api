<?php
namespace LibertAPI\Tests\Units\Utilisateur;

use \LibertAPI\Utilisateur\UtilisateurDao as _Dao;

/**
 * Classe de test du DAO de l'utilisateur
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 */
final class UtilisateurDao extends \LibertAPI\Tests\Units\Tools\Libraries\ADao
{
    /*************************************************
     * GET
     *************************************************/

    /**
     * Teste la méthode getById avec un id non trouvé
     */
    public function testGetByIdNotFound()
    {
        $this->exception(function () {
            $this->newTestedInstance($this->connector)->getById(0);
        });
    }

    /**
     * Teste la méthode getById avec un id trouvé
     */
    public function testGetByIdFound()
    {
        $this->exception(function () {
            $this->newTestedInstance($this->connector)->getById(0);
        });
    }

    /*************************************************
     * POST
     *************************************************/

    public function testPost()
    {
        $dao = new _Dao($this->connector);
        $this->variable($dao->post([]))->isNull();
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
            'token' => 'token',
            'date_last_access' => 'date_last_access',
        ], 'Aladdin');

        $this->variable($put)->isNull();
    }

    /*************************************************
     * DELETE
     *************************************************/

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
