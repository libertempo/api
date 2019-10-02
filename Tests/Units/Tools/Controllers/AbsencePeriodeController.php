<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Tools\Controllers;

use Psr\Http\Message\ResponseInterface as IResponse;
use LibertAPI\Tools\Exceptions\UnknownResourceException;

/**
 * Classe de test de période d'absence
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.6
 */
final class AbsencePeriodeController extends \LibertAPI\Tests\Units\Tools\Libraries\ARestController
{
    /**
     * {@inheritdoc}
     */
    protected function initRepository()
    {
        $this->mockGenerator->orphanize('__construct');
        $this->repository = new \mock\LibertAPI\Absence\Periode\PeriodeRepository();
    }

    /**
     * {@inheritdoc}
     */
    protected function initEntite()
    {
        $this->entite = new \LibertAPI\Absence\Periode\Entite();
        $this->entite->setLogin('Donatello');
        $this->entite->setDateDeb('2018-12-25');
        $this->entite->setDemiJourDeb('am');
        $this->entite->setDateFin('2018-12-31');
        $this->entite->setDemiJourFin('pm');
        $this->entite->setPNbJours('42');
        $this->entite->setCommentaire('Cowabunga');
        $this->entite->setType('1');
        $this->entite->setEtat('ajout');
        $this->entite->setEditionId('88');
        $this->entite->setMotifRefus('Shredder');
        $this->entite->setDateDemande('2018-10-12');
        $this->entite->setDateTraitement('2018-11-11');
        $this->entite->setFermetureId('4');
    }

    protected function getOne() : IResponse
    {
        return $this->testedInstance->get($this->request, $this->response, ['periodeId' => 99]);
    }

    protected function getList() : IResponse
    {
        return $this->testedInstance->get($this->request, $this->response, []);
    }

    final protected function getEntiteContent() : array
    {
        return [];
    }
}
