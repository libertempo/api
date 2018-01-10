<?php
namespace LibertAPI\Heure\HautResponsable\Repos;

use LibertAPI\Tools\Interfaces;
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
 */
final class ReposController extends \LibertAPI\Tools\Libraries\AController
implements Interfaces\IGetable, Interfaces\IPostable, Interfaces\IPutable, Interfaces\IDeletable
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
        if (!isset($arguments['reposId'])) {
            return $this->getList($request, $response, $arguments['employe'], (int) $arguments['statut']);
        }

        return $this->getOne($response, (int) $arguments['reposId']);
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
    private function getOne(IResponse $response, $id, $reposId)
    {
        try {
            $responseResource = $this->repository->getOne($id, $reposId);
        } catch (\DomainException $e) {
            return $this->getResponseNotFound($response, 'Element « repos#' . $id . ' » is not a valid resource');
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
     * Retourne un tableau d'heure de repos
     *
     * @param IRequest $request Requête Http
     * @param IResponse $response Réponse Http
     * @param int $reposStatut Contrainte de recherche sur le statut
     * @param int $employe Contrainte de recherche sur l'employé
     *
     * @return IResponse
     * @throws \Exception en cas d'erreur inconnue (fallback, ne doit pas arriver)
     */
    private function getList(IRequest $request, IResponse $response, $employe, $reposStatut)
    {
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
            $entites[] = $this->buildData($responseResource);
        }

        return $this->getResponseSuccess($response, $entites, 200);
    }

    /**
     * Construit le « data » du json
     *
     * @param ReposEntite $entite repos
     *
     * @return array
     */
    private function buildData(ReposEntite $entite)
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

    /**
     * {@inheritDoc}
     */
    public function post(IRequest $request, IResponse $response, array $routeArguments)
    {
        $body = $request->getParsedBody();
        if (null === $body) {
            return $this->getResponseBadRequest($response, 'Body request is not a json content');
        }

        try {
            $reposId = $this->repository->postOne($body, new ReposEntite([]));
        } catch (MissingArgumentException $e) {
            return $this->getResponseMissingArgument($response);
        } catch (\DomainException $e) {
            return $this->getResponseBadDomainArgument($response, $e);
        } catch (\Exception $e) {
            return $this->getResponseError($response, $e);
        }

        return $this->getResponseSuccess(
            $response,
            $this->router->pathFor('getReposDetail', [
                'reposId' => $reposId
            ]),
            201
        );
    }

    /**
     * {@inheritDoc}
     */
    public function put(IRequest $request, IResponse $response, array $arguments)
    {
        $body = $request->getParsedBody();
        if (null === $body) {
            return $this->getResponseBadRequest($response, 'Body request is not a json content');
        }

        $id = (int) $arguments['reposId'];
        try {
            $resource = $this->repository->getOne($id);
        } catch (\DomainException $e) {
            return $this->getResponseNotFound($response, 'Element « repos#' . $id . ' » is not a valid resource');
        } catch (\Exception $e) {
            return $this->getResponseError($response, $e);
        }

        try {
            $this->repository->putOne($body, $resource);
        } catch (MissingArgumentException $e) {
            return $this->getResponseMissingArgument($response);
        } catch (\DomainException $e) {
            return $this->getResponseBadDomainArgument($response, $e);
        } catch (\Exception $e) {
            return $this->getResponseError($response, $e);
        }

        return $this->getResponseSuccess($response, '', 204);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(IRequest $request, IResponse $response, array $arguments)
    {
        $id = (int) $arguments['reposId'];
        try {
            $resource = $this->repository->getOne($id);
            $this->repository->deleteOne($resource);
            $code = 200;
            $data = [
                'code' => $code,
                'status' => 'success',
                'message' => '',
                'data' => '',
            ];

            return $response->withJson($data, $code);
        } catch (\DomainException $e) {
            return $this->getResponseNotFound($response, 'Element « repos#' . $id . ' » is not a valid resource');
        } catch (\Exception $e) {
            throw $e;
        }
    }
}