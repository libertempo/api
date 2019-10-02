<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Tools\Controllers;

use Psr\Http\Message\ResponseInterface as IResponse;
use \LibertAPI\Tools\Exceptions\UnknownResourceException;

/**
 * Classe de test du contrôleur de l'utilisateur
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.6
 */
final class UtilisateurController extends \LibertAPI\Tests\Units\Tools\Libraries\ARestController
{
    /**
     * @var \LibertAPI\Tools\Libraries\ARepository Mock du repository associé
     */
    protected $repository;

    /**
     * @var \LibertAPI\Tools\Libraries\AEntite Mock de l'entité associée
     */
    protected $entite;

    /**
     * {@inheritdoc}
     */
    protected function initRepository()
    {
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->repository = new \mock\LibertAPI\Utilisateur\UtilisateurRepository();
    }

    /**
     * {@inheritdoc}
     */
    protected function initEntite()
    {
        $this->entite = new \LibertAPI\Utilisateur\Entite();
        $this->entite->setNom('I. Gadget');
        $this->entite->setPrenom('Inspecteur');
        $this->entite->setIsResp('N');
        $this->entite->setIsHr('Y');
        $this->entite->setIsActive('Y');
        $this->entite->setPasswd('Sophie');
        $this->entite->setQuotite(400);
        $this->entite->setEmail('gadget@fino.com');
        $this->entite->setNumExercice(7);
        $this->entite->setPlanningId(88);
        $this->entite->setHeureSolde(12);
        $this->entite->setDateInscription('2018-12-26');
        $this->entite->setDateLastAccess('2018-12-26');
    }

    protected function getOne() : IResponse
    {
        return $this->testedInstance->get($this->request, $this->response, ['utilisateurId' => 99]);
    }

    protected function getList() : IResponse
    {
        return $this->testedInstance->get($this->request, $this->response, []);
    }

    /*************************************************
     * PUT
     *************************************************/


    final protected function getEntiteContent() : array
    {
        return [];
    }
}
