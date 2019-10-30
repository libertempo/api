<?php declare(strict_types = 1);

use Psr\Container\ContainerInterface as C;
use Doctrine\ORM\EntityManager;
use DI\Container;
use Invoker\CallableResolver;
use Slim\Http\Headers;
use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use Slim\Interfaces\RouterInterface as IRouter;
use LibertAPI\Tools\Controllers\AuthentificationController;
use LibertAPI\Utilisateur\UtilisateurRepository;
use LibertAPI\Tools\Libraries\Application;
use LibertAPI\Tools\Libraries\StorageConfiguration;
use function DI\get;
use function DI\create;
use function DI\autowire;
use \Rollbar\Rollbar;

return configurationGenerale() + configurationPersonnelle();

function configurationGenerale() : array
{
    return [
        // Settings that can be customized by users
        'settings.httpVersion' => '1.1',
        'settings.responseChunkSize' => 4096,
        'settings.outputBuffering' => 'append',
        'settings.determineRouteBeforeAppMiddleware' => false,
        'settings.displayErrorDetails' => true,
        'settings.addContentLengthHeader' => true,
        'settings.routerCacheFile' => false,

        // Defaults settings
        'settings' => [
            'httpVersion' => get('settings.httpVersion'),
            'responseChunkSize' => get('settings.responseChunkSize'),
            'outputBuffering' => get('settings.outputBuffering'),
            'determineRouteBeforeAppMiddleware' => get('settings.determineRouteBeforeAppMiddleware'),
            'displayErrorDetails' => get('settings.displayErrorDetails'),
            'addContentLengthHeader' => get('settings.addContentLengthHeader'),
            'routerCacheFile' => get('settings.routerCacheFile'),
        ],
        IRouter::class => get('router'),
        'router' => create(Slim\Router::class)
            ->method('setContainer', get(Container::class))
            ->method('setCacheFile', get('settings.routerCacheFile')),
        Slim\Router::class => get('router'),
        'callableResolver' => autowire(CallableResolver::class),
        'environment' => function (C $c) {
            return new Slim\Http\Environment($_SERVER);
        },
        'request' => function (C $c) {
            return Request::createFromEnvironment($c->get('environment'));
        },
        'response' => function (C $c) {
            $headers = new Headers(['Content-Type' => 'application/json; charset=UTF-8']);
            $response = new Response(200, $headers);
            return $response->withProtocolVersion($c->get('settings')['httpVersion']);
        },
    ];
}

function configurationPersonnelle() : array
{
    return configurationHandlers() + configurationLibertempo();
}

function configurationHandlers() : array
{
    return [
        'foundHandler' => create(\Slim\Handlers\Strategies\RequestResponse::class),
        'badRequestHandler' => function (C $c) {
            return function (IRequest $request, IResponse $response) use ($c) {
                return call_user_func(
                    $c->get('clientErrorHandler'),
                    $request,
                    $response,
                    400,
                    'Request Content-Type and Accept must be set on application/json only'
                );
            };
        },
        'forbiddenHandler' => function (C $c) {
            return function (IRequest $request, IResponse $response) use ($c) {
                return call_user_func(
                    $c->get('clientErrorHandler'),
                    $request,
                    $response,
                    403,
                    'User has not access to « ' . $request->getUri()->getPath() . ' » resource'
                );
            };
        },
        'unauthorizedHandler' => function (C $c) {
            return function (IRequest $request, IResponse $response) use ($c) {
                return call_user_func(
                    $c->get('clientErrorHandler'),
                    $request,
                    $response,
                    401,
                    'Bad API Key'
                );
            };
        },
        'notFoundHandler' => function (C $c) {
            return function (IRequest $request, IResponse $response) use ($c) {
                return call_user_func(
                    $c->get('clientErrorHandler'),
                    $request,
                    $response,
                    404,
                    '« ' . $request->getUri()->getPath() . ' » is not a valid resource'
                );
            };
        },
        'clientErrorHandler' => function (C $c) {
            return function (IRequest $request, IResponse $response, int $code, string $messageData) {
                $responseUpd = $response->withStatus($code);
                $data = [
                    'code' => $code,
                    'status' => 'fail',
                    'message' => $responseUpd->getReasonPhrase(),
                    'data' => $messageData,
                ];
                Rollbar::warning($code . ' ' . $messageData);

                return $responseUpd->withJson($data);
            };
        },
        'phpErrorHandler' => function (C $c) {
            return function (IRequest $request, IResponse $response, \Throwable $throwable) use ($c) {
                return call_user_func(
                    $c->get('serverErrorHandler'),
                    $request,
                    $response,
                    $throwable
                );
            };
        },
        'errorHandler' => function (C $c) {
            return function (IRequest $request, IResponse $response, \Exception $exception) use ($c) {
                return call_user_func(
                    $c->get('serverErrorHandler'),
                    $request,
                    $response,
                    $exception
                );
            };
        },
        'serverErrorHandler' => function (C $c) {
            return function (IRequest $request, IResponse $response, \Throwable $throwable) {
                Rollbar::error($throwable->getMessage(), ['trace' => substr($throwable->getTraceAsString(), 0, 1000) . '[...]']);

                $code = 500;
                $responseUpd = $response->withStatus($code);
                return $responseUpd->withJson([
                    'code' => $code,
                    'status' => 'error',
                    'message' => $responseUpd->getReasonPhrase(),
                    'data' => $throwable->getMessage(),
                ]);
            };
        },
        'notAllowedHandler' => function (C $c) {
            return function (IRequest $request, IResponse $response, array $methods) use ($c) {
                $methodString = implode(', ', $methods);
                $responseUpd = call_user_func(
                    $c->get('clientErrorHandler'),
                    $request,
                    $response,
                    405,
                    'Method on « ' . $request->getUri()->getPath() . ' » must be one of : ' . $methodString
                );

                return $responseUpd->withHeader('Allow', $methodString);
            };
        },
    ];
}

function configurationLibertempo() : array
{
    return [
        AuthentificationController::class => function (C $c) {
            $repo = $c->get(UtilisateurRepository::class);
            $repo->setApplication($c->get(Application::class));
            return new AuthentificationController($repo, $c->get(IRouter::class), $c->get(StorageConfiguration::class));
        },
        Doctrine\DBAL\Driver\Connection::class => function (C $c) {
            return $c->get('storageConnector');
        },
        EntityManager::class => get('entityManager'),
    ];
}
