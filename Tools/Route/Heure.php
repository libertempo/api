<?php declare(strict_types = 1);

use LibertAPI\Tools\Controllers\HeureReposUtilisateurController;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;

/*
 * Doit être importé après la création de $app. Ne créé rien.
 *
 * La convention de nommage est de mettre les routes au singulier
 */

/* Routes sur l'heure */
$app->group('/heure', function () {
    $this->group('/repos', function () {
        $this->get('/utilisateur/me', function (IRequest $request, IResponse $response, array $args) {
            $args = array_merge($args, ['currentUser' => $this->get('currentUser')]);

            // @TODO: Voir s'il s'agit de la meilleure méthode, vis à vis du métier
            return $this->get(HeureReposUtilisateurController::class)->get($request, $response, $args);
        })->setName('getHeureReposUtilisateurMeListe');
    });
});
