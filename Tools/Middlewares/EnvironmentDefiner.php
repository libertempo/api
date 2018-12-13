<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Middlewares;

use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use \Rollbar\Rollbar;

/**
 * Définit toutes les particularités d'environnement
 *
 * @since 1.5
 */
final class EnvironmentDefiner extends \LibertAPI\Tools\AMiddleware
{
    public function __invoke(IRequest $request, IResponse $response, callable $next) : IResponse
    {
        $configuration = $this->getContainer()->get('configurationFileData');
        $stage = (!isset($configuration->stage) || 'development' !== $configuration->stage)
            ? 'production'
            : 'development';
        if ('development' == $stage) {
            $this->defineDevelopment();
        } else {
            $this->defineProduction();
        }

        return $next($request, $response);
    }

    private function defineDevelopment()
    {
        ini_set('assert.exception', '1');
        error_reporting(-1);
        ini_set("display_errors", '1');
        $configuration = $this->getContainer()->get('configurationFileData');
        if (!empty($configuration->logger_token)) {

            Rollbar::init([
                'access_token' => $configuration->logger_token,
                'environment' => 'development',
                'use_error_reporting' => true,
                'allow_exec' => false,
                'included_errno' => E_ALL,
            ]);
            \Rollbar\Rollbar::addCustom('access_key', $configuration->logger_token);
        }
    }

    private function defineProduction()
    {
        assert_options(ASSERT_ACTIVE, 0);
        ini_set('assert.exception', '0');
        error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
        ini_set("display_errors", '0');
    }
}
