<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Controllers;

use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use \Slim\Interfaces\RouterInterface as IRouter;
use LibertAPI\Utilisateur;
use LibertAPI\Tools\Exceptions\UnknownResourceException;


/**
 * Contrôleur d'utilisateurs
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.4
 * @see \LibertAPI\Utilisateur\UtilisateurController
 *
 * Ne devrait être contacté que par le routeur
 * Ne devrait contacter que le Utilisateur\Repository
 */
final class UtilisateurEmployeController extends \LibertAPI\Tools\Libraries\AController
{
    public function __construct(Utilisateur\UtilisateurRepository $repository, IRouter $router)
    {
        parent::__construct($repository, $router);
    }

    /*************************************************
     * GET
     *************************************************/

    /* Mettre le niveau de droits autorisés
        && ce que ces droits permettre de voir (l'utilisateur peut-il voir HR / admin ?)
     */

     /**
      * {@inheritDoc}
      */
    public function get(IRequest $request, IResponse $response, array $arguments) : IResponse
    {
        unset($arguments);

        return $this->getOne($request, $response);
    }

    /**
     * Retourne un élément unique
     *
     * @param IResponse $response Réponse Http
     * @param int $id ID de l'élément
     *
     * @return IResponse, 404 si l'élément n'est pas trouvé, 200 sinon
     */
    private function getOne(IRequest $request, IResponse $response) : IResponse
    {
        $id = $request->getAttribute('currentUser')->getLogin();
        try {
            $utilisateur = $this->repository->getOne($id);
        } catch (UnknownResourceException $e) {
            return $this->getResponseNotFound($response, 'Element « utilisateurs#' . $id . ' » is not a valid resource');
        } catch (\Exception $e) {
            return $this->getResponseError($response, $e);
        }

        return $this->getResponseSuccess(
            $response,
            $this->buildData($utilisateur),
            200
        );
    }

    /**
     * Construit le « data » du json
     *
     * @param Utilisateur\UtilisateurEntite $entite Utilisateur
     *
     * @return array
     */
    private function buildData(Utilisateur\UtilisateurEntite $entite)
    {
        return [
            'id' => $entite->getId(),
            'login' => $entite->getLogin(),
            'nom' => $entite->getNom(),
            'prenom' => $entite->getPrenom(),
            'is_responsable' => $entite->isResponsable(),
            'is_haut_responsable' => $entite->isHautResponsable(),
            'is_actif' => $entite->isActif(),
            'quotite' => $entite->getQuotite(),
            'mail' => $entite->getMail(),
            'numero_exercice' => $entite->getNumeroExercice(),
            'planning_id' => $entite->getPlanningId(),
            'heure_solde' => $entite->getHeureSolde(),
            'date_inscription' => $entite->getDateInscription(),
            // mettre le lien du planning associé, sous un offset formalisé
        ];
    }
}
