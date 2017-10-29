<?php
namespace LibertAPI\Tests\Units\Tools\Libraries;

use LibertAPI\Tools\Libraries\AControllerFactory as _AControllerFactory;
use LibertAPI\Tools\Libraries\AController as _AController;

/**
 * Test de la fabrication de contrôleurs
 *
 * @since 0.2
 */
final class AControllerFactory extends \Atoum
{
    /**
     * @var \mock\PDO Connecteur BD
     */
    private $storageConnector;

    /**
     * @var \mock\PDOStatement Mock du curseur de résultat PDO
     */
    private $statement;

    /**
     * @var \mock\Slim\Slim\Router Mock du routeur
     */
    private $router;

    /**
     * Init des tests
     */
    public function beforeTestMethod($method)
    {
        parent::beforeTestMethod($method);
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->statement = new \mock\PDOStatement();
        $this->statement->getMockController()->fetchAll = [];
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->mockGenerator->orphanize('__construct');
        $this->storageConnector = new \mock\PDO();
        $this->storageConnector->getMockController()->query = $this->statement;
        $this->router = new \mock\Slim\Router();
    }

    /**
     * Test de la création de contrôleur pour une ressource inconnue
     */
    public function testCreateControllerNotFound()
    {
        $this->exception(function () {
            _AControllerFactory::createControllerAuthentification('notFoundNs', $this->storageConnector, $this->router);
        })->isInstanceOf('\DomainException');
    }

    /**
     * Test de la création de contrôleur pour l'authentification
     */
    public function testCreateControllerAuthentification()
    {
        $controller = _AControllerFactory::createControllerAuthentification('Authentification', $this->storageConnector, $this->router);

        $this->object($controller)->isInstanceOf(\LibertAPI\Authentification\AuthentificationController::class);
    }

    /**
     * Test de la création de contrôleur pour la plupart des ressources connues
     */
    public function testCreateControllerDefault()
    {
        $controller = _AControllerFactory::createControllerWithUser('Planning', $this->storageConnector, $this->router, new \LibertAPI\Utilisateur\UtilisateurEntite([]));

        $this->object($controller)->isInstanceOf(_AController::class);
    }

    /**
     * Test de la résolution de namespace pour le contrôleur
     */
    public function testGetControllerClassname()
    {
        $ressource = 'Planning\Creneau';

        $this->string(_AControllerFactory::getControllerClassname($ressource))
            ->isIdenticalTo('\LibertAPI\Planning\Creneau\CreneauController')
        ;
    }
}
