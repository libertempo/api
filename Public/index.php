<?php declare(strict_types = 1);
/**
 * API de Libertempo
 * @since 0.1
 */

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', dirname(__DIR__));
define('TOOLS_PATH', ROOT_PATH . DS . 'Tools');
define('TESTS_FUNCTIONALS_PATH', ROOT_PATH . DS . 'Tests' . DS . 'Functionals');

/**
 * Find autoloader in a package context AND in a library context
 */
function findAutoloader(string $dir)
{
    if (is_dir($dir . DS . 'Vendor')) {
        require_once $dir . DS . 'Vendor' . DS . 'autoload.php';
        return;
    } elseif (is_dir($dir . DS . 'vendor')) {
        require_once $dir . DS . 'vendor' . DS . 'autoload.php';
        return;
    }
    return findAutoloader(dirname($dir));
}

findAutoloader(ROOT_PATH);

$app = require_once TOOLS_PATH . DS . 'App.php';
/* Jump in ! */
$app->run();
