<?php
namespace App\Components\Authentification;

use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;

/**
 * Contrôleur de l'authentification
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 * @see \Tests\Units\App\Components\Authentification\Controller
 *
 * Ne devrait être contacté que par le routeur
 * Ne devrait contacter que le Authentification\Repository
 */
final class Controller extends \App\Libraries\AController
{
    /*************************************************
     * GET
     *************************************************/

    /**
     * Execute l'ordre HTTP GET pour la récupération du token
     *
     * @param IRequest $request Requête Http
     * @param IResponse $response Réponse Http
     *
     * @return IResponse
     */
    public function get(IRequest $request, IResponse $response)
    {
        $body = $request->getParsedBody();
        if (null === $body) {
            return $this->getResponseBadRequest($response);
        }

        try {
            $utilisateur = $this->repository->find([]);
            $utilisateurUpdate = $this->repository->regenerateToken($utilisateur);

            $code = 200;
            $data = [
                'code' => $code,
                'status' => 'success',
                'message' => '',
                'data' => $utilisateurUpdate->getToken(),
            ];

            return $response->withJson($data, $code);
        } catch (\UnexpectedValueException $e) {
            return $this->getResponseNotFound($response, 'No user matches these criteria');
        }
    }
}
