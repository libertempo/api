<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Controllers;

use LibertAPI\Tools\Interfaces;
use LibertAPI\Tools\Exceptions\MissingArgumentException;
use LibertAPI\Tools\Exceptions\UnknownResourceException;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use \Slim\Interfaces\RouterInterface as IRouter;
use LibertAPI\Absence\Type;
use Doctrine\ORM\EntityManager;

/**
 * Contrôleur de type d'absence
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.5
 */
final class AbsenceTypeController extends \LibertAPI\Tools\Libraries\AController
implements Interfaces\IGetable, Interfaces\IPostable, Interfaces\IPutable, Interfaces\IDeletable
{
    public function __construct(Type\TypeRepository $repository, IRouter $router, EntityManager $entityManager)
    {
        parent::__construct($repository, $router, $entityManager);
    }

    /**
     * {@inheritDoc}
     */
    public function get(IRequest $request, IResponse $response, array $arguments) : IResponse
    {
        if (!isset($arguments['typeId'])) {
            return $this->getList($request, $response);
        }
        return $this->getOne($response, (int) $arguments['typeId']);
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
            $resource = $this->entityManager->find(Type\Entite::class, $id);
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
            $repository = $this->entityManager->getRepository(Type\Entite::class);
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
     * @param Type\Entite $entite Type
     *
     * @return array
     */
    private function buildData(Type\Entite $entite)
    {
        return [
            'id' => $entite->getId(),
            'type' => $entite->getType(),
            'libelle' => $entite->getLibelle(),
            'libelleCourt' => $entite->getShortLibelle(),
            'typeNatif' => $entite->isTypeNatif(),
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
            $type = new Type\Entite();
            $type->setType($body['type']);
            $type->setLibelle($body['libelle']);
            $type->setShortLibelle($body['libelleCourt']);
            $type->setTypeNatif($body['typeNatif']);

            $this->entityManager->persist($type);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return $this->getResponseError($response, $e);
        }

        return $this->getResponseSuccess(
            $response,
            $this->router->pathFor('getAbsenceTypeDetail', [
                'typeId' => $type->getId()
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

        $id = (int) $arguments['typeId'];
        try {
            $resource = $this->entityManager->find(Type\Entite::class, $id);
            if (null === $resource) {
                return $this->getResponseNotFound($response, 'Element « #' . $id . ' » is not a valid resource');
            }
            $resource->setType($body['type']);
            $resource->setLibelle($body['libelle']);
            $resource->setShortLibelle($body['libelleCourt']);
            $resource->setTypeNatif($body['typeNatif']);

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
        $id = (int) $arguments['typeId'];
        try {
            $resource = $this->entityManager->find(Type\Entite::class, $id);
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
