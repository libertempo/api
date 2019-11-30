<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Controllers;

use LibertAPI\Tools\Interfaces;
use \Slim\Interfaces\RouterInterface as IRouter;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use LibertAPI\Groupe\GrandResponsable;
use Doctrine\ORM\EntityManager;

/**
 * Contrôleur de grand responsable de groupes
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.0
 *
 * Ne devrait être contacté que par le routeur
 * Ne devrait contacter que le GrandResponsableRepository
 */
final class GroupeGrandResponsableController extends \LibertAPI\Tools\Libraries\AController
implements Interfaces\IGetable
{
    public function __construct(GrandResponsable\GrandResponsableRepository $repository, IRouter $router, EntityManager $entityManager)
    {
        parent::__construct($repository, $router, $entityManager);
    }

    /**
     * {@inheritDoc}
     */
    public function get(IRequest $request, IResponse $response, array $arguments) : IResponse
    {
        try {
            $repository = $this->entityManager->getRepository(GrandResponsable\Entite::class);
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
     * @param GrandResponsable\GrandResponsableEntite $entite Responsable
     *
     * @return array
     */
    private function buildData(GrandResponsable\GrandResponsableEntite $entite) : array
    {
        return [
            'login' => $entite->getLogin(),
        ];
    }
}
