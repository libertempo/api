<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\JourFerie;

use LibertAPI\JourFerie\JourFerieEntite;

/**
 * Classe de test du DAO de jour férié
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.0
 */
final class JourFerieDao extends \LibertAPI\Tests\Units\Tools\Libraries\ADao
{
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

    /**
     * Teste la méthode delete quand tout est ok
     */
    public function testDeleteOk()
    {
        $this->exception(function () {
            $this->newTestedInstance($this->connector)->delete(0);
        });
    }

    protected function getStorageContent()
    {
        return [
            'id' => uniqid(),
            'jf_date' => '2018-05-14',
        ];
    }
}
