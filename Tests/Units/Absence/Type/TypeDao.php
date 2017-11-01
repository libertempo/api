<?php
namespace LibertAPI\Tests\Units\Absence\Type;

/**
 * Classe de test du DAO de type d'absence
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.5
 */
final class TypeDao extends \LibertAPI\Tests\Units\Tools\Libraries\ADao
{
    /*************************************************
     * GET
     *************************************************/

    /**
     * Teste la méthode getById avec un id non trouvé
     */
    public function testGetByIdNotFound()
    {
        $this->calling($this->result)->fetch = [];
        $this->newTestedInstance($this->connector);

        $get = $this->testedInstance->getById(99);

        $this->array($get)->isEmpty();
    }

    /**
     * Teste la méthode getById avec un id trouvé
     */
    public function testGetByIdFound()
    {
        $this->calling($this->result)->fetch = ['a'];
        $this->newTestedInstance($this->connector);

        $get = $this->testedInstance->getById(99);

        $this->array($get)->isNotEmpty();
    }

    /**
     * Teste la méthode getList avec des critères non pertinents
     */
    public function testGetListNotFound()
    {
        $this->calling($this->result)->fetchAll = [];
        $this->newTestedInstance($this->connector);

        $get = $this->testedInstance->getList([]);

        $this->array($get)->isEmpty();
    }

    /**
     * Teste la méthode getList avec des critères pertinents
     */
    public function testGetListFound()
    {
        $this->calling($this->result)->fetchAll = [['a']];
        $this->newTestedInstance($this->connector);

        $get = $this->testedInstance->getList([]);

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
        $this->calling($this->connector)->lastInsertId = 314;
        $this->newTestedInstance($this->connector);

        $postId = $this->testedInstance->post([
            'type' => 'type',
            'libelle' => 'libelle',
            'libelleCourt' => 'libelleCourt',
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
        $this->newTestedInstance($this->connector);

        $put = $this->testedInstance->put([
            'type' => 'type',
            'libelle' => 'libelle',
            'libelleCourt' => 'libelleCourt',
        ], 12);

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

        $this->integer($res)->isIdenticalTo(1);
    }
}
