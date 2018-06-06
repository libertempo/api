<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Controllers;

use LibertAPI\Tools\Interfaces;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use \Slim\Interfaces\RouterInterface as IRouter;
use LibertAPI\Utilisateur\UtilisateurEntite;
use LibertAPI\Groupe\Responsable;

/**
 * Contrôleur de responsable de groupes
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.7
 *
 * Ne devrait être contacté que par le routeur
 * Ne devrait contacter que le ResponsableRepository
 */
class ResponsableGroupeController extends EmployeGroupeController
implements Interfaces\IGetable
{
    public function __construct(Responsable\ResponsableRepository $repository, IRouter $router)
    {
        $this->repository = $repository;
        $this->router = $router;
    }

}
