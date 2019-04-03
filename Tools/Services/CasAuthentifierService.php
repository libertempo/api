<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Services;

use \jasig\Client;
use Psr\Http\Message\ServerRequestInterface as IRequest;

/**
 * Service d'authentification via un serveur CAS
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina <wouldsmina@tuxfamily.org>
 *
 * @since 1.8
 */
class CasAuthentifierService extends AAuthentifierFactoryService
{
    public function __construct(Client $cas)
    {
        $this->cas = $cas;
    }

    /**
     * @inheritDoc
     * @require that configuration of cas is present
     */
    public function isAuthentificationSucceed(IRequest $request) : bool
    {
        $this->storeBasicIdentificants($request);
        assert(isset($request->getAttribute('configurationFileData')->cas));
        $configurationCas = $request->getAttribute('configurationFileData')->cas;

        $server = $configurationCas->serveur;
        $username = $this->getLogin();
        $proxyTicket = $this->getPassword();

        return true;
    }

    /**
     * @var AdldapInterface Service LDAP
     */
    private $cas;
}
