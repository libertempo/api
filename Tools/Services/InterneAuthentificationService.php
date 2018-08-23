<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Services;

use Psr\Http\Message\ServerRequestInterface as IRequest;

/**
 *
 */
class InterneAuthentificationService extends AAuthentificationFactoryService
{
    public function isAuthentificationSucceed(IRequest $request) : bool
    {
    }
}
