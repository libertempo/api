<?php declare(strict_types = 1);

use LibertAPI\Tools\Controllers\SoldeEmployeController;

/*
 * Doit être importé après la création de $app. Ne créé rien.
 *
 * La convention de nommage est de mettre les routes au singulier
 */

/* Routes sur le solde */
$app->get('/employe/me/solde', [SoldeController::class, 'get'])->setName('getSoldeEmployeMeListe');
