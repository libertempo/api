<?php declare(strict_types = 1);
/*
 * Doit être importé après la création de $app. Ne créé rien.
 *
 * La convention de nommage est de mettre les routes au singulier
 */

/* Routes sur le groupe */
$app->group('/groupe', function () {
    $this->group('/{groupeId:[0-9]+}', function () {
        /* Detail */
        $this->get('', 'controller:get')->setName('getGroupeDetail');

        /* Dependances de groupe : responsable */
        $this->get('/responsable', 'controller:get')->setName('getGroupeResponsableListe');

        /* Dependances de groupe : grand responsable */
        $this->get('/grand_responsable', 'controller:get')->setName('getGroupeGrandResponsableListe');
    });

    /* Collection */
    $this->get('', 'controller:get')->setName('getGroupeListe');
});
