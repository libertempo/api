<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Heure\Repos;

/**
 * Classe de test de l'entité d'heure de repos
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.8
 */
final class ReposEntite extends \LibertAPI\Tests\Units\Tools\Libraries\AEntite
{
    /**
     * @inheritDoc
     */
    public function testConstructWithId()
    {
        $id = 58;
        $commentaire = 'Barry Allen';
        $commentaireRefus = 'Barry Allen 2';

        $this->newTestedInstance([
            'id' => $id,
            'login' => 'Abagnale',
            'debut' => 1000,
            'fin' => 1100,
            'duree' => 10,
            'type_periode' => 7,
            'statut' => 10,
            'commentaire' => $commentaire,
            'commentaire_refus' => $commentaireRefus,
        ]);

        $this->assertConstructWithId($this->testedInstance, $id);
        $this->string($this->testedInstance->getLogin())->isIdenticalTo('Abagnale');
        $this->integer($this->testedInstance->getDebut())->isIdenticalTo(1000);
        $this->integer($this->testedInstance->getFin())->isIdenticalTo(1100);
        $this->integer($this->testedInstance->getDuree())->isIdenticalTo(10);
        $this->integer($this->testedInstance->getTypePeriode())->isIdenticalTo(7);
        $this->integer($this->testedInstance->getStatut())->isIdenticalTo(10);
        $this->string($this->testedInstance->getCommentaire())->isIdenticalTo($commentaire);
        $this->string($this->testedInstance->getCommentaireRefus())->isIdenticalTo($commentaireRefus);
    }

    /**
     * @inheritDoc
     */
    public function testConstructWithoutId()
    {
        $this->newTestedInstance([
            'login' => 'Abagnale',
            'debut' => 1000,
        ]);
        $this->variable($this->testedInstance->getId())->isNull();
    }

    /**
     * @inheritDoc
     */
    public function testReset()
    {
        $this->newTestedInstance(['login' => 'Abagnale', 'debut' => 1000,]);

        $this->assertReset($this->testedInstance);
    }
}
