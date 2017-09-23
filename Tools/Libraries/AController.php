<?php
namespace LibertAPI\Tools\Libraries;

use LibertAPI\Tools\Libraries\ARepository;
use \Slim\Interfaces\RouterInterface as IRouter;
use Psr\Http\Message\ResponseInterface as IResponse;

/**
 * Contrôleur principal
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.1
 *
 * Ne devrait être contacté par personne
 * Ne devrait contacter personne
 */
abstract class AController
{
    /**
     * @var ARepository Repository de la ressource
     */
    protected $repository;

    /**
     * @var IRouter Routeur de l'application
     */
    protected $router;

    public function __construct(ARepository $repository, IRouter $router)
    {
        $this->repository = $repository;
        $this->router = $router;
    }

    /**
     * Retourne une réponse 400 normalisée
     *
     * @param IResponse $response Réponse Http
     * @param string $message Message d'erreur
     *
     * @return IResponse
     */
    protected function getResponseBadRequest(IResponse $response, $message)
    {
        return $this->getResponseError($response, 'Bad Request', ['data' => $message], 400);
    }

    /**
     * Retourne une réponse normalisée d'argument manquant
     *
     * @param IResponse $response Réponse Http
     *
     * @return IResponse
     */
    protected function getResponseMissingArgument(IResponse $response)
    {
        return $this->getResponseError($response, 'Precondition Failed', ['data' => 'Missing required argument'], 412);
    }

    /**
     * Retourne une réponse normalisée d'argument en bad domaine
     *
     * @param IResponse $response Réponse Http
     * @param \Exception $e Tableau des champs en erreur jsonEncodé
     *
     * @return IResponse
     */
    protected function getResponseBadDomainArgument(IResponse $response, \Exception $e)
    {
        return $this->getResponseError($response, 'Precondition Failed', ['data' => json_decode($e->getMessage(), true)], 412);
    }

    /**
     * Retourne une réponse normalisée d'élément non trouvé
     *
     * @param IResponse $response Réponse Http
     * @param string $messageData Message data d'un json bien formé
     *
     * @return IResponse
     */
    protected function getResponseNotFound(IResponse $response, $messageData)
    {
        return $this->getResponseError($response, 'Not Found', ['data' => $messageData], 404);
    }

    /**
     * Retourne une réponse normalisée d'élément sans contenu
     *
     * @param IResponse $response Réponse Http
     *
     * @return IResponse
     */
    protected function getResponseNoContent(IResponse $response)
    {
        return $this->getResponseSuccess($response, 'No Content', [], 204);
    }

    /**
     * Retourne une réponse d'erreur normalisée
     *
     * @param IResponse $response Réponse Http
     * @param string $message Précision de l'erreur
     * @param array $data
     * @param int $code Code Http
     *
     * @return IResponse
     */
    private function getResponseError(IResponse $response, $message, array $data, $code)
    {
        $data += [
            'code' => $code,
            'status' => 'error',
            'message' => $message
        ];

        return $this->getResponse($response, $data);
    }

    /**
     * Retourne une réponse normalisée en cas de succès
     *
     * @param IResponse $response Réponse Http
     * @param string $message Message data d'un json bien formé
     * @param array $data
     * @param int $code Code Http
     *
     * @return IResponse
     */
    private function getResponseSuccess(IResponse $response, $message, array $data, $code)
    {
        $data += [
            'code' => $code,
            'status' => 'success',
            'message' => $message
        ];

        return $this->getResponse($response, $data);
    }

    /**
     * Retourne une réponse normalisée
     *
     * @param IResponse $response Réponse Http
     * @param array $data
     *
     * @return IResponse
     */
    private function getResponse(IResponse $response, array $data)
    {
        return $response->withJson($data, $data['code']);
    }
}