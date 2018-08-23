<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Services;

use Psr\Http\Message\ServerRequestInterface as IRequest;

/**
 *
 */
class LdapAuthentifierService extends AAuthentifierFactoryService
{
    public function isAuthentificationSucceed(IRequest $request) : bool
    {
    }

    public function getLogin() : string
    {
    }
}
