<?php
/*
 * Doit être importé après la création de $app. Ne créé rien.
 *
 * La convention de nommage est de mettre les routes au pluriel
 */

/* Routes sur une absence et associés */
$app->group('/absences', function () {
    /* Route sur un type d'absence */
    $this->group('/types', function () {
        $type = '\LibertAPI\Absence\Type\TypeController';

        /* Collection */
        $this->get('', $type . ':get')->setName('getAbsenceTypeListe');
    });
});
