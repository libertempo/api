<?php
namespace LibertAPI\Heure\HautResponsable\Repos;

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
final class ReposController extends \LibertAPI\Tools\Libraries\AController
{
    /**
     * {@inheritDoc}
     */
    protected function ensureAccessUser($order, \LibertAPI\Utilisateur\UtilisateurEntite $utilisateur)
    {
    }

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
        try {
            $responseResource = $this->repository->getOne($id, $heureId);
        } catch (\DomainException $e) {
            return $this->getResponseNotFound($response, 'Element « heure#' . $id . ' » is not a valid resource');
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
     * Retourne un tableau d'heure
     *
     * @param IRequest $request Requête Http
     * @param IResponse $response Réponse Http
     * @param int $heureStatut Contrainte de recherche sur le statut
     * @param int $employe Contrainte de recherche sur l'employé
     *
     * @return IResponse
     * @throws \Exception en cas d'erreur inconnue (fallback, ne doit pas arriver)
     */
    private function getList(IRequest $request, IResponse $response, $employe, $heureStatut)
    {
        $code = -1;
        $data = [];
        try {
            $this->ensureAccessUser(__FUNCTION__, $this->currentUser);
            $responseResources = $this->repository->getList(
                $request->getQueryParams()
            );
        } catch (\UnexpectedValueException $e) {
            return $this->getResponseNoContent($response);
        } catch (\Exception $e) {
            return $this->getResponseError($response, $e);
        }
        $entites = [];
        foreach ($responseResources as $responseResource) {
            $entites[] = $this->buildData($heure);
        }

        return $this->getResponseSuccess($response, $entites, 200);
    }

    /**
     * Construit le « data » du json
     *
     * @param HeureEntite $entite heure
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