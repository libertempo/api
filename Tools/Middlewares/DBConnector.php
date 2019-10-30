<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Middlewares;

use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use Doctrine\DBAL;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

/**
 * Connexion DB
 *
 * @since 1.0
 */
final class DBConnector extends \LibertAPI\Tools\AMiddleware
{
    public function __invoke(IRequest $request, IResponse $response, callable $next) : IResponse
    {
        $dbh = ('ci' === $request->getHeaderLine('stage', null))
            ? $this->getTestBase()
            : $this->getRealBase();
        $connexion = DBAL\DriverManager::getConnection(['pdo' => $dbh]);

        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;
        $paths = [__DIR__ . '/'];
        $configuration = Setup::createAnnotationMetadataConfiguration(
            $paths,
            $isDevMode,
            $proxyDir,
            $cache,
            $useSimpleAnnotationReader
        );
        $this->getContainer()->set('storageConnector', $connexion);
        $em = EntityManager::create($connexion, $configuration);
        $this->getContainer()->set('entityManager', $em);

        return $next($request, $response);
    }

    private function getTestBase() : \PDO
    {
        $dbh = new \PDO('sqlite:' . TESTS_FUNCTIONALS_PATH . DS . '_data/current.sqlite');
        $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
        /* Push last access date on the fly */
        $hours = 6 * 3600;
        $newDate = date('Y-m-d H:i', time() + $hours);
        $dbh->query('UPDATE `conges_users` SET date_last_access = "' . $newDate . '"');

        return $dbh;
    }

    private function getRealBase() : \PDO
    {
        $configuration = $this->getContainer()->get('configurationFileData');
        $dbh = new \PDO(
            'mysql:host=' . $configuration->db->serveur . ';dbname=' . $configuration->db->base,
            $configuration->db->utilisateur,
            $configuration->db->mot_de_passe,
            [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'utf8\';']
        );

        return $dbh;
    }
}
