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
}
