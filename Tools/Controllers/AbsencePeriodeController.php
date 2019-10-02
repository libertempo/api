<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Controllers;

use LibertAPI\Tools\Interfaces;
use LibertAPI\Tools\Exceptions\UnknownResourceException;
use LibertAPI\Absence\Periode\PeriodeEntite;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use \Slim\Interfaces\RouterInterface as IRouter;
use LibertAPI\Absence\Periode;
use Doctrine\ORM\EntityManager;

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
    public function __construct(Periode\PeriodeRepository $repository, IRouter $router, EntityManager $entityManager)
    {
        parent::__construct($repository, $router, $entityManager);
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
            $periode = $this->entityManager->find(Periode\Entite::class, $id);
            if (null === $periode) {
                return $this->getResponseNotFound($response, '« #' . $id . ' » is not a valid resource');
            }
        } catch (\Exception $e) {
            return $this->getResponseError($response, $e);
        }

        return $this->getResponseSuccess(
            $response,
            $this->buildData($periode),
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
            $repository = $this->entityManager->getRepository(Periode\Entite::class);
            $periodes = $repository->findAll();
        } catch (\UnexpectedValueException $e) {
            return $this->getResponseNoContent($response);
        } catch (\Exception $e) {
            return $this->getResponseError($response, $e);
        }
        $entites = array_map([$this, 'buildData'], $periodes);

        return $this->getResponseSuccess($response, $entites, 200);
    }

    /**
     * Construit le « data » du json
     *
     * @param Periode\PeriodeEntite $entite Période
     *
     * @return array
     */
    private function buildData(Periode\Entite $entite)
    {
        return [
            'id' => $entite->getNum(),
            'login' => $entite->getLogin(),
            'dateDebut' => $entite->getDateDeb(),
            'demiJourneeDebut' => $entite->getDemiJourDeb(),
            'dateFin' => $entite->getDateFin(),
            'demiJourneeFin' => $entite->getDemiJourFin(),
            'nombreJours' => $entite->getPNbJours(),
            'commentaire' => $entite->getCommentaire(),
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
