<?php
namespace LibertAPI\Tools\Libraries;

use \Slim\Interfaces\RouterInterface as IRouter;
use LibertAPI\Tools\Libraries\Application;
use Doctrine\DBAL\Driver\Connection;

/**
 * Fabrique des contrôleurs, basé sur les dépendances
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 *
 * Ne devrait être contacté que par \LibertAPI\Tools\Middlewares
 * Peut contacter tous les contrôleurs
 */
abstract class AControllerFactory
{
    /**
     * Créé le bon contrôleur avec les bonnes dépendances en fonction de la requête
     *
     * @param string $ressourcePath
     * @param Connection $storageConnector Connecteur à la BDD
     * @param IRouter $router Routeur de l'application
     *
     * @return \LibertAPI\Tools\Libraries\AController
     * @throws \DomainException Si la ressource est inconnue
     */
    final static function createController($ressourcePath, Connection $storageConnector, IRouter $router)
    {
        $controllerClass = static::getControllerClassname($ressourcePath);
        $paths = explode('\\', $ressourcePath);
        $end = array_pop($paths);
        if (!class_exists($controllerClass, true)) {
            throw new \DomainException('Unknown component');
        }

        switch ($ressourcePath) {
            case 'Authentification':
                $daoClass = '\LibertAPI\Utilisateur\UtilisateurDao';
                $repoClass = '\LibertAPI\Utilisateur\UtilisateurRepository';

                $repo = new $repoClass(
                    new $daoClass($storageConnector)
                );
                // TODO : Application est un injectable, supprimer la création ici
                $repo->setApplication(new Application($storageConnector));

                return new $controllerClass($repo, $router);

            default:
                $daoClass = '\LibertAPI\\' . $ressourcePath . '\\' . $end . 'Dao';
                $repoClass = '\LibertAPI\\' . $ressourcePath . '\\' . $end . 'Repository';

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
        $paths = explode('\\', $ressourcePath);
        $end = array_pop($paths);
        return '\LibertAPI\\' . $ressourcePath . '\\' . $end . 'Controller';
    }
}
