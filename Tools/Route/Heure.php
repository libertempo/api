<?php declare(strict_types = 1);

use LibertAPI\Tools\Controllers\HeureReposUtilisateurController;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;

/*
 * Doit être importé après la création de $app. Ne créé rien.
 *
 * La convention de nommage est de mettre les routes au singulier
 */

// Ce sont des routes sur l'heure, oui, mais l'association est à l'envers : je veux les heures qui ME sont associées. C'est donc /employe/me/heure_repos
// Dans tous les cas, c'est une bonne pratique de transmettre l'utilisateur courant dans le controleur

/* Routes sur l'heure */
$app->group('/heure', function () {
    $this->group('/repos', function () {
        $this->get('/employe/me', [HeureReposEmployeController::class, 'get'])->setName('getHeureReposUtilisateurMeListe');
    });
});
