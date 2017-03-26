<?php
namespace Tests\Units\App\Components\Utilisateur;

use \App\Components\Utilisateur\Dao as _Dao;

/**
 * Classe de test du DAO de l'utilisateur
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 */
final class Dao extends \Tests\Units\App\Libraries\ADao
{
    /*************************************************
     * GET
     *************************************************/

    /**
     * Teste la méthode getList avec des critères non pertinents
     */
    public function testGetListNotFound()
    {
        $this->statement->getMockController()->fetchAll = [];
        $dao = new _Dao($this->connector);

        $get = $dao->getList([]);

        $this->array($get)->isEmpty();
    }

    /**
     * Teste la méthode getList avec des critères pertinents
     */
    public function testGetListFound()
    {
        $this->statement->getMockController()->fetchAll = [['a']];
        $dao = new _Dao($this->connector);

        $get = $dao->getList([]);

        $this->array($get[0])->isNotEmpty();
    }
}
