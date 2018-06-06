<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Controllers;

use LibertAPI\Tools\Interfaces;
use \Slim\Interfaces\RouterInterface as IRouter;
use LibertAPI\Groupe\GrandResponsable;

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
final class GrandResponsableGroupeController extends ResponsableGroupeController
implements Interfaces\IGetable
{
    public function __construct(GrandResponsable\GrandResponsableRepository $repository, IRouter $router)
    {
        $this->repository = $repository;
        $this->router = $router;
    }

}
