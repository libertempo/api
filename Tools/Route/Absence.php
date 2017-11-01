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
        /* Détail */
        $typeNS = '\LibertAPI\Absence\Type\TypeController';
        $this->get('/{typeId:[0-9]+}', $typeNS . ':get')->setName('getAbsenceTypeDetail');
        /* Collection */
        $this->get('', $typeNS . ':get')->setName('getAbsenceTypeListe');
    });
});
