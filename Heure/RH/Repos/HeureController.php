<?php
namespace LibertAPI\Heure\RH\Repos;

use LibertAPI\Tools\Exceptions\MissingArgumentException;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;

/**
 * Contrôleur des heures de repos
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina <wouldsmina@gmail.com>
 *
 * @since 0.6
 * @see \Tests\Units\Heure\Repos
 *
 * Ne devrait être contacté que par le routeur
 * Ne devrait contacter que Heure\Repository
 */
final class HeureController extends \LibertAPI\Tools\Libraries\AController
{
    /*************************************************
     * GET
     *************************************************/

    /**
     * Execute l'ordre HTTP GET
     *
     * @param IRequest $request Requête Http
     * @param IResponse $response Réponse Http
     *
     * @return IResponse
     */
    public function get(IRequest $request, IResponse $response, array $arguments)
    {
        if (!isset($arguments['heureId'])) {
            return $this->getList($request, $response, $arguments['employe'], (int) $arguments['statut']);
        }

        return $this->getOne($response, (int) $arguments['heureId']);
    }

    /**
     * Retourne un élément unique
     *
     * @param IResponse $response Réponse Http
     * @param int $id ID de l'élément
     * @param int $statut Contrainte de recherche sur l'heure de repos
     *
     * @return IResponse, 404 si l'élément n'est pas trouvé, 200 sinon
     * @throws \Exception en cas d'erreur inconnue (fallback, ne doit pas arriver)
     */
    private function getOne(IResponse $response, $id, $heureId)
    {
        $code = -1;
        $data = [];
        try {
            $heure = $this->repository->getOne($id, $heureId);
            $code = 200;
            $data = [
                'code' => $code,
                'statut' => 'success',
                'message' => '',
                'data' => $this->buildData($heure),
            ];

            return $response->withJson($data, $code);
        } catch (\DomainException $e) {
            $code = 404;
            $data = [
                'code' => $code,
                'statut' => 'error',
                'message' => 'Not Found',
                'data' => 'Element « heure#' . $id . ' » is not a valid resource',
            ];

            return $response->withJson($data, $code);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Retourne un tableau de plannings
     *
     * @param IRequest $request Requête Http
     * @param IResponse $response Réponse Http
     * @param int $planningId Contrainte de recherche sur le planning
     *
     * @return IResponse
     * @throws \Exception en cas d'erreur inconnue (fallback, ne doit pas arriver)
     */
    private function getList(IRequest $request, IResponse $response, $employe, $heureStatut)
    {
        $code = -1;
        $data = [];
        try {
            $heures = $this->repository->getList(['heureStatut' => $heureStatut, 'employe' => $employe]);
            $entites = [];
            foreach ($heures as $heure) {
                $entites[] = $this->buildData($heure);
            }
            $code = 200;
            $data = [
                'code' => $code,
                'statut' => 'success',
                'message' => '',
                'data' => $entites,
            ];

            return $response->withJson($data, $code);
        } catch (\UnexpectedValueException $e) {
            return $this->getResponseNoContent($response);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Construit le « data » du json
     *
     * @param CreneauEntite $entite Créneau de planning
     *
     * @return array
     */
    private function buildData(HeureEntite $entite)
    {
        return [
            'id' => $entite->getId(),
            'employe' => $entite->getEmployeId(),
            'debut' => $entite->getDebut(),
            'fin' => $entite->getFin(),
            'duree' => $entite->getduree(),
            'statut' => $entite->getStatut(),
            'typePeriode' => $entite->getTypePeriode(),
            'commentaire' => $entite->getCommentaire(),
            'commentaireRefus' => $entite->getCommentaireRefus(),
        ];
    }

}