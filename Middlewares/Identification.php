<?php
namespace Middlewares;

use App\Libraries\AModel;
use Psr\Http\Message\ServerRequestInterface as IRequest;

/**
 * Identification d'un utilisateur via la transmission du token
 *
 * @since 0.1
 */
final class Identification
{
    /**
     * @var \App\Libraries\AModel
     */
    private $utilisateur;

    public function __construct(IRequest $request, \App\Libraries\ARepository $repository)
    {
        $token = $request->getHeaderLine('Token');
        if ('' === $token) {
            return;
        }
        try {
            $this->utilisateur = $repository->find([
                'token' => $token,
                'gt_date_last_access' => $this->getDateLastAccessAuthorized()
            ]);
        } catch (\UnexpectedValueException $e) {
            return;
        }
    }

    /**
     * Retourne la date limite de dernier accès pour être considéré en ligne
     *
     * @return string
     */
    private function getDateLastAccessAuthorized()
    {
        return date('Y-m-d H:i', time() - 15 * 60);
    }

    /**
     * Vérifie que la clé d'api fournie est la bonne
     *
     * @return bool
     */
    public function isTokenOk()
    {
        return $this->getUtilisateur() instanceof AModel;
    }

    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}
