<?php
namespace App\Components\Upgrade;

use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;

/**
 * Contrôleur des upgrades (au sens large, installation comprise)
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 * @see \Tests\Units\App\Components\Upgrade\Controller
 *
 * Ne devrait être contacté que par le routeur
 */
final class Controller
{
    /*************************************************
     * GET
     *************************************************/

    /**
     * Execute l'ordre HTTP GET
     *
     * @param IRequest $request Requête Http
     * @param IResponse $response Réponse Http
     *
     * @return IResponse
     */
    public function get(IRequest $request, IResponse $response)
    {
        $code = 200;
        $data = [
            'code' => $code,
            'status' => 'success',
            'message' => hash('sha256', time()),
            'data' => '',
        ];

        return $response->withJson($data, $code);

        // installation du token d'instance dans la DB
    }
}
