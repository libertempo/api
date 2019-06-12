<?php declare(strict_types = 1);

use LibertAPI\Tools\Controllers\HeureReposEmployeController;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;

/*
 * Doit être importé après la création de $app. Ne créé rien.
 *
 * La convention de nommage est de mettre les routes au singulier
 */

/* Routes sur l'heure */
$app->group('/employe/me/heure/', function () {
    $this->group('/repos', function () {
        $app->get('/employe/me/heure/repos', [HeureReposEmployeController::class, 'get'])->setName('getHeureReposEmployeMeListe');
    });

    $this->group('/additionnelle', function () {
        $app->get('/employe/me/heure/additionnelle', [HeureAdditionnelleEmployeController::class, 'get'])->setName('getHeureAdditionnelleEmployeMeListe');
    });
});
