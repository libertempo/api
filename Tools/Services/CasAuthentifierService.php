<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Services;

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
    public function __construct()
    {
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
        $uri = $configurationCas->uri;
        $username = $this->getLogin();
        $proxyTicket = $this->getPassword();
        // pour vérifier le proxyTicket il faut GET vers https://$server/$uri/proxyValidate?ticket=$proxyTicket&service=https://url_api
        // le retour se fait par code http (200 ou 404). à vérifier.


        return true;
    }
}
