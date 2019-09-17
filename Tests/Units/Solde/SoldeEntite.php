<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Solde;

use \LibertAPI\Solde\SoldeEntite as _Entite;

/**
 * Classe de test de l'entité d'heure de Additionnelle
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina <wouldsmina@gmail.com>
 *
 * @since 1.9
 */
final class SoldeEntite extends \LibertAPI\Tests\Units\Tools\Libraries\AEntite
{
    /**
     * @inheritDoc
     */
    public function testConstructWithId()
    {
        $id = 'octavia';
        $entite = new _Entite(['id' => $id]);

        $this->string($entite->getId())->isIdenticalTo($id);
    }

    /**
     * @inheritDoc
     */
    public function testConstructWithoutId()
    {
        $this->newTestedInstance([
            'type_absence' => 1,
            'solde_annuel' => 100,
            'solde' => 10.5,
            'reliquat' => 7.5,
        ]);
        $this->variable($this->testedInstance->getId())->isNull();
    }

    /**
     * @inheritDoc
     */
    public function testReset()
    {
        $this->newTestedInstance(['login' => 'octavia', 'type_absence' => 1,]);

        $this->assertReset($this->testedInstance);
    }
}
