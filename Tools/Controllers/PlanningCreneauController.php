<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Controllers;

use LibertAPI\Tools\Exceptions\MissingArgumentException;
use LibertAPI\Tools\Interfaces;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use \Slim\Interfaces\RouterInterface as IRouter;
use LibertAPI\Planning\Creneau;
use LibertAPI\Tools\Exceptions\UnknownResourceException;
use Doctrine\ORM\EntityManager;

/**
 * Contrôleur des creneaux de plannings
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.1
 *
 * Ne devrait être contacté que par le routeur
 * Ne devrait contacter que le Planning\Repository
 */
final class PlanningCreneauController extends \LibertAPI\Tools\Libraries\AController
implements Interfaces\IGetable, Interfaces\IPostable, Interfaces\IPutable
{
    public function __construct(Creneau\CreneauRepository $repository, IRouter $router, EntityManager $entityManager)
    {
        parent::__construct($repository, $router, $entityManager);
    }

    /**
     * {@inheritDoc}
     */
    public function get(IRequest $request, IResponse $response, array $arguments) : IResponse
    {
        if (!isset($arguments['creneauId'])) {
            return $this->getList($response, (int) $arguments['planningId']);
        }

        return $this->getOne($response, (int) $arguments['creneauId']);
    }

    /**
     * Retourne un élément unique
     *
     * @param IResponse $response Réponse Http
     * @param int $id ID de l'élément
     *
     * @return IResponse, 404 si l'élément n'est pas trouvé, 200 sinon
     */
    private function getOne(IResponse $response, $id)
    {
        try {
            $resource = $this->entityManager->find(Creneau\Entite::class, $id);
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
     * @param IResponse $response Réponse Http
     * @param int $planningId Contrainte de recherche sur le planning
     *
     * @return IResponse
     */
    private function getList(IResponse $response, $planningId)
    {
        try {
            $repository = $this->entityManager->getRepository(Creneau\Entite::class);
            $resources = $repository->findBy(['planningId' => $planningId]);
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
     * @param Creneau\CreneauEntite $entite Créneau de planning
     *
     * @return array
     */
    private function buildData(Creneau\Entite $entite)
    {
        return [
            'id' => $entite->getCreneauId(),
            'planningId' => $entite->getPlanningId(),
            'jourId' => $entite->getJourId(),
            'typeSemaine' => $entite->getTypeSemaine(),
            'typePeriode' => $entite->getTypePeriode(),
            'debut' => $entite->getDebut(),
            'fin' => $entite->getFin(),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function post(IRequest $request, IResponse $response, array $arguments) : IResponse
    {
        $body = $request->getParsedBody();
        if (null === $body) {
            return $this->getResponseBadRequest($response, 'Body request is not a json content');
        }
        if (is_array($body) && !is_array(reset($body))) {
            return $this->getResponseBadRequest($response, 'Body request is not a creneaux list');
        }
        $planningId = (int) $arguments['planningId'];

        try {
            $creneaux = [];
            foreach ($body as $c) {
                $creneau = new Creneau\Entite();
                $creneau->setPlanningId($planningId);
                $creneau->setJourId($c['jourId']);
                $creneau->setTypeSemaine($c['typeSemaine']);
                $creneau->setTypePeriode($c['typePeriode']);
                $creneau->setDebut($c['debut']);
                $creneau->setFin($c['fin']);

                $this->entityManager->persist($creneau);
                $creneaux[] = $creneau;
            }
            $this->entityManager->flush();

            $dataMessage = [];
            foreach ($creneaux as $c) {
                $dataMessage[] = $this->router->pathFor('getPlanningCreneauDetail', [
                    'creneauId' => $c->getCreneauId(),
                    'planningId' => $c->getPlanningId(),
                ]);
            }
        } catch (\Exception $e) {
            return $this->getResponseError($response, $e);
        }

        return $this->getResponseSuccess(
            $response,
            $dataMessage,
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

        $id = (int) $arguments['creneauId'];

        try {
            $resource = $this->entityManager->find(Creneau\Entite::class, $id);
            if (null === $resource) {
                return $this->getResponseNotFound($response, 'Element « #' . $id . ' » is not a valid resource');
            }
            $resource->setPlanningId($body['planningId']);
            $resource->setJourId($body['jourId']);
            $resource->setTypeSemaine($body['typeSemaine']);
            $resource->setTypePeriode($body['typePeriode']);
            $resource->setDebut($body['debut']);
            $resource->setFin($body['fin']);

            $this->entityManager->flush();
        } catch (\DomainException $e) {
            return $this->getResponseBadDomainArgument($response, $e);
        } catch (\Exception $e) {
            return $this->getResponseError($response, $e);
        }

        return $this->getResponseSuccess($response, '', 204);
    }
}
