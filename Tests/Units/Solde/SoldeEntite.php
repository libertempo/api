<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Solde;

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

        $this->newTestedInstance([
            'id' => 'octavia',
            'login' => 'octavia',
            'type_absence' => 1,
            'solde_annuel' => 100,
            'solde' => 10.5,
            'reliquat' => 7.5,
        ]);

        $this->assertConstructWithId($this->testedInstance, 'octavia');
        $this->string($this->testedInstance->getLogin())->isIdenticalTo('octavia');
        $this->integer($this->testedInstance->getTypeAbsence())->isIdenticalTo(1);
        $this->integer($this->testedInstance->getSoldeAn())->isIdenticalTo(100);
        $this->integer($this->testedInstance->getSolde())->isIdenticalTo(10.5);
        $this->integer($this->testedInstance->getReliquat())->isIdenticalTo(7.5);
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
