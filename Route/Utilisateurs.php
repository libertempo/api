<?php
/*
 * Doit être importé après la création de $app. Ne créé rien.
 *
 * La convention de nommage est de mettre les routes au pluriel
 */

/* Routes sur l'utilisateur et associés */
$app->group('/utilisateurs', function () {
    $utilisateurNS = \App\Components\Utilisateur\Controller::class;
    /* Collection */
    $this->get('', $planningNS .  ':get')->setName('getPlanningListe');
});
