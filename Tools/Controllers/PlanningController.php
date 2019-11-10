<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Controllers;

use LibertAPI\Tools\Exceptions\MissingArgumentException;
use LibertAPI\Tools\Exceptions\UnknownResourceException;
use LibertAPI\Tools\Interfaces;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use \Slim\Interfaces\RouterInterface as IRouter;
use LibertAPI\Planning;
use Doctrine\ORM\EntityManager;

/**
 * Contrôleur de planning
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.1
 *
 * Ne devrait être contacté que par le routeur
 * Ne devrait contacter que le PlanningRepository
 */
final class PlanningController extends \LibertAPI\Tools\Libraries\AController
implements Interfaces\IGetable, Interfaces\IPostable, Interfaces\IPutable, Interfaces\IDeletable
{
    public function __construct(Planning\PlanningRepository $repository, IRouter $router, EntityManager $entityManager)
    {
        parent::__construct($repository, $router, $entityManager);
    }

    /**
     * {@inheritDoc}
     */
    public function get(IRequest $request, IResponse $response, array $arguments) : IResponse
    {
        if (!isset($arguments['planningId'])) {
            return $this->getList($request, $response);
        }

        return $this->getOne($response, (int) $arguments['planningId']);
    }

    /**
     * Retourne un élément unique
     *
     * @param IResponse $response Réponse Http
     * @param int $id ID de l'élément
     *
     * @return IResponse
     */
    private function getOne(IResponse $response, $id)
    {
        try {
            $resource = $this->entityManager->find(Planning\Entite::class, $id);
            if (null === $resource) {
                return $this->getResponseNotFound($response, 'Element « #' . $id . ' » is not a valid resource');
            }
        } catch (\Exception $e) {
            return $this->getResponseError($response, $e);
        }

        return $this->getResponseSuccess(
            $response,
            $this->buildData($resource),
            200
        );
    }

    /**
     * Retourne un tableau de plannings
     *
     * @param IRequest $request Requête Http
     * @param IResponse $response Réponse Http
     *
     * @return IResponse
     */
    private function getList(IRequest $request, IResponse $response)
    {
        try {
            $repository = $this->entityManager->getRepository(Planning\Entite::class);
            $resources = $repository->findAll();
            if (empty($resources)) {
                return $this->getResponseNoContent($response);
            }
        } catch (\Exception $e) {
            return $this->getResponseError($response, $e);
        }
        $entites = array_map([$this, 'buildData'], $resources);

        return $this->getResponseSuccess($response, $entites, 200);
    }

    /**
     * Construit le « data » du json
     *
     * @param Planning\PlanningEntite $entite Planning
     *
     * @return array
     */
    private function buildData(Planning\Entite $entite)
    {
        return [
            'id' => $entite->getId(),
            'name' => $entite->getName(),
            'status' => $entite->getStatus(),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function post(IRequest $request, IResponse $response, array $routeArguments) : IResponse
    {
        $body = $request->getParsedBody();
        if (null === $body) {
            return $this->getResponseBadRequest($response, 'Body request is not a json content');
        }

        try {
            $planning = new Planning\Entite();
            $planning->setName($body['name']);
            $planning->setStatus($body['status']);

            $this->entityManager->persist($planning);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return $this->getResponseError($response, $e);
        }

        return $this->getResponseSuccess(
            $response,
            $this->router->pathFor('getPlanningDetail', [
                'planningId' => $planning->getId()
            ]),
            201
        );
    }

    /**
     * {@inheritDoc}
     */
    public function put(IRequest $request, IResponse $response, array $arguments) : IResponse
    {
        $body = $request->getParsedBody();
        if (null === $body) {
            return $this->getResponseBadRequest($response, 'Body request is not a json content');
        }

        $id = (int) $arguments['planningId'];

        try {
            $resource = $this->entityManager->find(Planning\Entite::class, $id);
            if (null === $resource) {
                return $this->getResponseNotFound($response, 'Element « #' . $id . ' » is not a valid resource');
            }
            $resource->setName($body['name']);
            $resource->setStatus($body['status']);

            $this->entityManager->flush();
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
    public function delete(IRequest $request, IResponse $response, array $arguments) : IResponse
    {
        $id = (int) $arguments['planningId'];
        try {
            $resource = $this->entityManager->find(Planning\Entite::class, $id);
            if (null === $resource) {
                return $this->getResponseNotFound($response, 'Element « #' . $id . ' » is not a valid resource');
            }

            $this->entityManager->remove($resource);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return $this->getResponseError($response, $e);
        }

        return $this->getResponseSuccess($response, '', 200);
    }
}
