<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Controllers;

use LibertAPI\Tools\Interfaces;
use LibertAPI\Tools\Exceptions\UnknownResourceException;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use \Slim\Interfaces\RouterInterface as IRouter;
use LibertAPI\Absence\Periode;

/**
 * Contrôleur de période d'absence
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.6
 */
final class AbsencePeriodeController extends \LibertAPI\Tools\Libraries\AController
implements Interfaces\IGetable
{
    public function __construct(Periode\PeriodeRepository $repository, IRouter $router)
    {
        parent::__construct($repository, $router);
    }

    /**
     * {@inheritDoc}
     */
    public function get(IRequest $request, IResponse $response, array $arguments) : IResponse
    {
        if (!isset($arguments['periodeId'])) {
            return $this->getList($request, $response);
        }
        return $this->getOne($response, (int) $arguments['periodeId']);
    }

    /**
     * Retourne un élément unique
     *
     * @param IResponse $response Réponse Http
     * @param int $id ID de l'élément
     *
     * @return IResponse, 404 si l'élément n'est pas trouvé, 200 sinon
     */
    private function getOne(IResponse $response, int $id) : IResponse
    {
        try {
            $responseResource = $this->repository->getOne($id);
        } catch (UnknownResourceException $e) {
            return $this->getResponseNotFound($response, 'Element « periode#' . $id . ' » is not a valid resource');
        } catch (\Exception $e) {
            return $this->getResponseError($response, $e);
        }

        return $this->getResponseSuccess(
            $response,
            $this->buildData($responseResource),
            200
        );
    }

    /**
     * Retourne un tableau de période d'absence
     *
     * @param IRequest $request Requête Http
     * @param IResponse $response Réponse Http
     *
     * @return IResponse
     */
    private function getList(IRequest $request, IResponse $response)
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
     *
     * @param Periode\PeriodeEntite $entite Période
     *
     * @return array
     */
    private function buildData(Periode\PeriodeEntite $entite)
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
