<?php declare(strict_types = 1);
/**
 * API de Libertempo
 * @since 0.1
 */

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', dirname(__DIR__) . DS);
define('TOOLS_PATH', ROOT_PATH . 'Tools' . DS);
define('TESTS_FUNCTIONALS_PATH', ROOT_PATH . 'Tests' . DS . 'Functionals' . DS);

require_once ROOT_PATH . 'Vendor' . DS . 'autoload.php';
$app = require_once TOOLS_PATH . 'App.php';
/* Jump in ! */
$app->run();
