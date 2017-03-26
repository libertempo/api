<?php
namespace Tests\Units\Middlewares;

use Middlewares\ControllerFactory as _ControllerFactory;
use App\Libraries\AController;

/**
 * Test de la fabrication de contrôleurs
 *
 * @since 0.2
 */
final class ControllerFactory extends \Atoum
{
    /**
     * @var \mock\PDO Connecteur BD
     */
    private $storageConnector;

    /**
     * @var \mock\Slim\Slim\Router Mock du routeur
     */
    private $router;

    /**
     * Init des tests
     */
    public function beforeTestMethod($method)
    {
        $this->mockGenerator->orphanize('__construct');
        $this->storageConnector = new \mock\PDO();
        $this->router = new \mock\Slim\Router();
    }

    /**
     * Test de la création de contrôleur pour une ressource inconnue
     */
    public function testCreateControllerNotFound()
    {
        $this->exception(function () {
            _ControllerFactory::createController('notFoundNs', $this->storageConnector, $this->router);
        })->isInstanceOf('\DomainException');
    }

    /**
     * Test de la création de contrôleur pour la plupart des ressources connues
     */
    public function testCreateControllerDefault()
    {
        $controller = _ControllerFactory::createController('Planning', $this->storageConnector, $this->router);

        $this->object($controller)->isInstanceOf(AController::class);
    }

    /**
     * Test de la résolution de namespace pour le contrôleur
     */
    public function testGetControllerClassname()
    {
        $ressource = 'Planning\Creneau';

        $this->string(_ControllerFactory::getControllerClassname($ressource))
            ->isIdenticalTo('\App\Components\Planning\Creneau\Controller')
        ;
    }
}
