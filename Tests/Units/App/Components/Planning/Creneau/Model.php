<?php
namespace Tests\Units\App\Components\Planning\Creneau;

use \App\Components\Planning\Creneau\Model as _Model;

/**
 * Classe de test du modèle de créneau
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.1
 */
final class Model extends \Tests\Units\App\Libraries\AModel
{
    /**
     * @inheritDoc
     */
    public function testConstructWithId()
    {
        $id = 3;
        $planning = 12;

        $entite = new _Model(['id' => $id, 'planningId' => $planning]);

        $this->assertConstructWithId($entite, $id);
        $this->integer($entite->getPlanningId())->isIdenticalTo($planning);
    }

    /**
     * Teste la méthode __construct sans Id (typiquement lors d'un post())
     */
    public function testConstructWithoutId()
    {
        $entite = new _Model(['planningId' => 34]);

        $this->variable($entite->getId())->isNull();
    }

    /**
     * Teste la méthode populate avec un mauvais domaine de définition
     */
    public function testPopulateBadDomain()
    {
        $entite = new _Model([]);
        $data = [
            'planningId' => '',
            'typeSemaine' => '',
            'typePeriode' => '',
            'jourId' => '',
            'debut' => '',
            'fin' => ''
        ];

        $this->exception(function () use ($entite, $data) {
            $entite->populate($data);
        })->isInstanceOf('\DomainException');
    }

    /**
     * Teste la méthode populate avec ok
     */
    public function testPopulateOk()
    {
        $entite = new _Model([]);
        $data = [
            'planningId' => 12,
            'typeSemaine' => 23,
            'typePeriode' => 34,
            'jourId' => 45,
            'debut' => 56,
            'fin' => 67,
        ];

        $entite->populate($data);

        $this->integer($entite->getPlanningId())->isIdenticalTo($data['planningId']);
        $this->integer($entite->getTypeSemaine())->isIdenticalTo($data['typeSemaine']);
        $this->integer($entite->getTypePeriode())->isIdenticalTo($data['typePeriode']);
        $this->integer($entite->getJourId())->isIdenticalTo($data['jourId']);
        $this->integer($entite->getDebut())->isIdenticalTo($data['debut']);
        $this->integer($entite->getFin())->isIdenticalTo($data['fin']);
    }

    /**
     * @inheritDoc
     */
    public function testReset()
    {
        $entite = new _Model(['id' => 39, 'planningId' => 'test']);

        $this->assertReset($entite);
    }

}
