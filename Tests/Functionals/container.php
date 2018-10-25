<?php
require dirname(__DIR__, 2) . '/Vendor/autoload.php';

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Container;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use LibertAPI\Tools\Middlewares;
use DI\ContainerBuilder;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', dirname(__DIR__, 2) . DS);
define('TOOLS_PATH', ROOT_PATH . 'Tools' . DS);
define('ROUTE_PATH', TOOLS_PATH . 'Route' . DS);



$container = new Container([
    App::class => function (ContainerInterface $c) {

        $containerBuilder = new ContainerBuilder;
        $containerBuilder->addDefinitions(ROOT_PATH . 'di-config.php');
        $app = new App($containerBuilder->build());

        // routes and middlewares here
        $app->add(new Middlewares\AccessChecker($app));
        $app->add(new Middlewares\Identificator($app));
        $app->add(new Middlewares\DBConnector($app));
        $app->add(new Middlewares\ResourceFormatter($app));
        $app->add(new Middlewares\HeadersChecker($app));

        $app->get('/hello_world', function(IRequest $request, IResponse $response) {
            return $response->withJson('Hi there !');
        });

        require_once ROUTE_PATH . 'Absence.php';
        require_once ROUTE_PATH . 'Authentification.php';
        require_once ROUTE_PATH . 'Groupe.php';
        require_once ROUTE_PATH . 'Journal.php';
        require_once ROUTE_PATH . 'JourFerie.php';
        require_once ROUTE_PATH . 'Planning.php';
        require_once ROUTE_PATH . 'Utilisateur.php';

        return $app;
    }
]);

return $container;
