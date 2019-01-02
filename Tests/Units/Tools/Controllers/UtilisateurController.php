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
        $this->entite = new \LibertAPI\Utilisateur\UtilisateurEntite([
            'id' => 42,
            'login' => 'I.Gadget',
            'nom' => 'Gadget',
            'prenom' => 'Inspecteur',
            'isResp' => false,
            'isAdmin' => false,
            'isHr' => true,
            'isActif' => true,
            'password' => 'Sophie',
            'quotite' => 400,
            'email' => 'gadget@fino.com',
            'numeroExercice' => '7',
            'planningId' => '88',
            'heureSolde' => 12,
            'dateInscription' => '2018-12-26',
            'dateLastAccess' => '2018-12-26',
        ]);
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
