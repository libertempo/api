<?php declare(strict_types = 1);

use LibertAPI\Tools\Controllers\GroupeController;
use LibertAPI\Tools\Controllers\GrandResponsableGroupeController;

/*
 * Doit être importé après la création de $app. Ne créé rien.
 *
 * La convention de nommage est de mettre les routes au singulier
 */

/* Routes sur le groupe */
$app->group('/groupe', function () {
    $this->group('/{groupeId:[0-9]+}', function () {
        /* Detail */
        $this->get('', [GroupeController::class, 'get'])->setName('getGroupeDetail');

        /* Dependances de groupe : responsable */
        $this->get('/responsable', ['controller', 'get'])->setName('getGroupeResponsableListe');

        /* Dependances de groupe : grand responsable */
        $this->get('/grand_responsable', [GrandResponsableGroupeController::class, 'get'])->setName('getGroupeGrandResponsableListe');

        /* Dependances de groupe : employe */
        $this->get('/employe', ['controller', 'get'])->setName('getGroupeEmployeListe');
    });

    /* Collection */
    $this->get('', [GroupeController::class, 'get'])->setName('getGroupeListe');
});
