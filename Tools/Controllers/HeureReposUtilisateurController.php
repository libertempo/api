<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Controllers;

use LibertAPI\Tools\Interfaces;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use \Slim\Interfaces\RouterInterface as IRouter;
use LibertAPI\Heure\Repos;

/**
 * Contrôleur des heures de repos
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.8
 */
final class HeureReposUtilisateurController extends \LibertAPI\Tools\Libraries\AController
implements Interfaces\IGetable
{
    public function __construct(Repos\ReposRepository $repository, IRouter $router)
    {
        parent::__construct($repository, $router);
    }

    /**
     * {@inheritDoc}
     */
    public function get(IRequest $request, IResponse $response, array $arguments) : IResponse
    {
        return $this->getList($request, $response);
    }

    /**
     * Retourne un tableau d'heures de repos
     *
     */
    private function getList(IRequest $request, IResponse $response) : IResponse
    {
        try {
            $responseResources = $this->repository->getList(
                $request->getQueryParams()
            );
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
            'dateDebut' => $entite->getDateDebut(),
            'demiJourneeDebut' => $entite->getDemiJourneeDebut(),
            'dateFin' => $entite->getDateFin(),
            'demiJourneeFin' => $entite->getDemiJourneeFin(),
            'nombreJours' => $entite->getNombreJours(),
            'type' => $entite->getType(),
            'etat' => $entite->getEtat(),
            'editionId' => $entite->getEditionId(),
            'motifRefus' => $entite->getMotifRefus(),
            'dateDemande' => $entite->getDateDemande(),
            'dateTraitement' => $entite->getDateTraitement(),
            'fermetureId' => $entite->getFermetureId(),
            'num' => $entite->getNum(),
        ];
    }
}
