<?php
/**
 * API de Libertempo
 * @since 1.3
 */
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use LibertAPI\Tools\Middlewares;
use DI\ContainerBuilder;

define('ROUTE_PATH', TOOLS_PATH . DS . 'Route');

$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions(ROOT_PATH . DS . 'di-config.php');
$app = new \Slim\App($containerBuilder->build());

/*
 * /!\ Les Middlewares sont executés en mode PILE : le premier de la liste est lancé en dernier
 */
$app->add(new Middlewares\AccessChecker($app));
$app->add(new Middlewares\Identificator($app));
$app->add(new Middlewares\DBConnector($app));
$app->add(new Middlewares\ResourceFormatter($app));
$app->add(new Middlewares\HeadersChecker($app));
$app->add(new Middlewares\EnvironmentDefiner($app));
$app->add(new Middlewares\ConfigurationFileChecker($app));

$app->get('/hello_world', function(IRequest $request, IResponse $response) {
    return $response->withJson('Hi there !');
});

require_once ROUTE_PATH . DS . 'Absence.php';
require_once ROUTE_PATH . DS . 'Authentification.php';
require_once ROUTE_PATH . DS . 'Groupe.php';
require_once ROUTE_PATH . DS . 'Heure.php';
require_once ROUTE_PATH . DS . 'Solde.php';
require_once ROUTE_PATH . DS . 'Journal.php';
require_once ROUTE_PATH . DS . 'JourFerie.php';
require_once ROUTE_PATH . DS . 'Planning.php';
require_once ROUTE_PATH . DS . 'Utilisateur.php';

return $app;
