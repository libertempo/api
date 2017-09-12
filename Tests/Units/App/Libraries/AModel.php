<?php
namespace Tests\Units\App\Libraries;

use \App\Libraries\AModel as _AModel;

/**
 * Classe commune de test sur les modèles
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.1
 */
abstract class AModel extends \Atoum
{
    /**
     * @var \App\Libraries\AModel $entite Modèle en cours de test
     */
    protected $entite;

    /**
    * Teste la méthode __construct avec un Id (typiquement lors d'un get())
     */
    abstract public function testConstructWithId();

    /**
     * Teste la méthode __construct sans Id (typiquement lors d'un post())
     */
    abstract public function testConstructWithoutId();

    /**
     * Asserters commun sur la construction avec id
     *
     * @param _AModel $entite
     * @param int $id Id de l'objet
     */
    final protected function assertConstructWithId(_AModel $entite, $id)
    {
        $this->integer($entite->getId())->isIdenticalTo($id);
    }

    /**
     * Teste la méthode reset
     */
    abstract public function testReset();

    /**
     * Asserteurs communs sur le reset
     */
    final protected function assertReset(_AModel $entite)
    {
        $entite->reset();

        $this->variable($entite->getId())->isNull();
    }
}
