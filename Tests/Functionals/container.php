<?php declare(strict_types = 1);
require dirname(__DIR__, 2) . '/Vendor/autoload.php';

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Container;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', dirname(__DIR__, 2) . DS);
define('TOOLS_PATH', ROOT_PATH . 'Tools' . DS);

$container = new Container([
    App::class => function (ContainerInterface $c) {
        $app = require_once TOOLS_PATH . 'App.php';
        return $app;
    }
]);

return $container;
