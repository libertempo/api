<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Services;

use LibertAPI\Tools\Libraries\StorageConfiguration;
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
    public function __construct(StorageConfiguration $configuration)
    {
        $this->configuration = $configuration;
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
        $apiUrl = urlencode($this->configuration->getUrlAccueil() . "/api/");

        $proxyValidateUrl = $configurationCas->serveur . "/" . $configurationCas->uri .
                        "/proxyValidate?ticket=" . $this->getPassword() .
                        "&service=" . $apiUrl;
        $username = $this->getLogin();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $proxyValidateUrl);
        $result = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        d($result);
        // vérifier le username

        return 200 == $code;
    }

    private $configuration;
}
