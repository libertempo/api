<?php
namespace Middlewares;

use App\Libraries\AController;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use \Slim\Interfaces\RouterInterface as IRouter;

/**
 * Fabrique des contrôleurs, basé sur les dépendances
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 *
 * Ne devrait être contacté que par \Middlewares
 * Peut contacter tous les contrôleurs
 */
abstract class ControllerFactory
{
    /**
     * Créé le bon contrôleur avec les bonnes dépendances en fonction de la requête
     *
     * @param string $ressourcePath
     * @param \PDO $storageConnector Connecteur à la BDD
     * @param IRouter $router Routeur de l'application
     *
     * @return AController
     * @throws \DomainException Si la ressource est inconnue
     */
    final static function createController($ressourcePath, \PDO $storageConnector, IRouter $router)
    {
        $controllerClass = static::getControllerClassname($ressourcePath);
        if (!class_exists($controllerClass, true)) {
            throw new \DomainException('Unknown component');
        }

        switch ($controllerClass) {
            case 'value':
                # code...
                break;

            default:
                $daoClass = '\App\Components\\' . $ressourcePath . '\Dao';
                $repoClass = '\App\Components\\' . $ressourcePath . '\Repository';

                return new $controllerClass(
                    new $repoClass(
                        new $daoClass($storageConnector)
                    ),
                    $router
                );
        }
    }

    /**
     * Résolution du namespace du contrôleur
     *
     * @param string $ressourcePath
     *
     * @return string
     */
    final static function getControllerClassname($ressourcePath)
    {
        return '\App\Components\\' . $ressourcePath . '\Controller';
    }
}
