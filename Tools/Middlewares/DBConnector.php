<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Middlewares;

use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use Doctrine\DBAL;

/**
 * Connexion DB
 *
 * @since 1.0
 */
final class DBConnector extends \LibertAPI\Tools\AMiddleware
{
    public function __invoke(IRequest $request, IResponse $response, callable $next) : IResponse
    {
        $container = $this->getContainer();
        if ('ci' === $request->getHeaderLine('stage', null)) {
            $dbh = new \PDO('sqlite:' . TESTS_FUNCTIONALS_PATH . '/_data/current.sqlite');
            $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
        } else {
            $configuration = $container->get('configurationFileData');
            $dbh = new \PDO(
                'mysql:host=' . $configuration->db->serveur . ';dbname=' . $configuration->db->base,
                $configuration->db->utilisateur,
                $configuration->db->mot_de_passe,
                [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'utf8\';']
            );
        }
        $connexion = DBAL\DriverManager::getConnection(['pdo' => $dbh]);
        $container->set('storageConnector', $connexion);

        return $next($request, $response);
    }
}
