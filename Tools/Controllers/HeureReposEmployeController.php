<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Controllers;

use LibertAPI\Tools\Interfaces;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use \Slim\Interfaces\RouterInterface as IRouter;
use LibertAPI\Heure\Repos;
use Doctrine\ORM\EntityManager;

/**
 * Contrôleur des heures de repos de l'employé courant
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.8
 */
final class HeureReposEmployeController extends \LibertAPI\Tools\Libraries\AController
implements Interfaces\IGetable
{
    public function __construct(Repos\ReposRepository $repository, IRouter $router, EntityManager $entityManager)
    {
        parent::__construct($repository, $router, $entityManager);
    }

    /**
     * {@inheritDoc}
     */
    public function get(IRequest $request, IResponse $response, array $arguments) : IResponse
    {
        unset($arguments);
        return $this->getList($request, $response);
    }

    /**
     * Retourne un tableau d'heures de repos
     */
    private function getList(IRequest $request, IResponse $response) : IResponse
    {
        $user = $request->getAttribute('currentUser');
        $arguments = array_merge($request->getQueryParams(), ['login' => $user->getLogin()]);
        try {
            $responseResources = $this->repository->getList($arguments);
        } catch (\UnexpectedValueException $e) {
            return $this->getResponseNoContent($response);
        } catch (\Exception $e) {
            return $this->getResponseError($response, $e);
        }
        $entites = array_map([$this, 'buildData'], $responseResources);

        return $this->getResponseSuccess($response, $entites, 200);
    }

    /**
     * Construit le « data » du json
     */
    private function buildData(Repos\ReposEntite $entite) : array
    {
        return [
            'id' => $entite->getId(),
            'login' => $entite->getLogin(),
            'debut' => $entite->getDebut(),
            'fin' => $entite->getFin(),
            'duree' => $entite->getDuree(),
            'type_periode' => $entite->getTypePeriode(),
            'statut' => $entite->getStatut(),
            'commentaire' => $entite->getCommentaire(),
            'commentaire_refus' => $entite->getCommentaireRefus(),
        ];
    }
}
