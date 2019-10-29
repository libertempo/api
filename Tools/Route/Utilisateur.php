<?php declare(strict_types = 1);

use LibertAPI\Tools\Controllers\UtilisateurController;
use LibertAPI\Tools\Controllers\UtilisateurEmployeController;

/*
 * Doit être importé après la création de $app. Ne créé rien.
 *
 * La convention de nommage est de mettre les routes au singulier
 */

/* Routes sur l'utilisateur et associés */

$app->get('/utilisateur', [UtilisateurController::class, 'get'])->setName('getUtilisateurListe');

$app->get('/employe/me', [UtilisateurEmployeController::class, 'get'])->setName('getUtilisateurListe');
