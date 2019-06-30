<?php declare(strict_types = 1);

use LibertAPI\Tools\Controllers\HeureReposEmployeController;
use LibertAPI\Tools\Controllers\HeureAdditionnelleEmployeController;
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
        $this->get('', [HeureReposEmployeController::class, 'get'])->setName('getHeureReposEmployeMeListe');
    });

    $this->group('/additionnelle', function () {
        $this->get('', [HeureAdditionnelleEmployeController::class, 'get'])->setName('getHeureAdditionnelleEmployeMeListe');
    });
});
