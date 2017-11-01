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
        $typeNS = '\LibertAPI\Absence\Type\TypeController';
        /* Détail */
        $this->group('/{typeId:[0-9]+}', function () use ($typeNS) {
            $this->get('', $typeNS . ':get')->setName('getAbsenceTypeDetail');
            $this->put('', $typeNS . ':put')->setName('putAbsenceTypeDetail');
            $this->delete('', $typeNS . ':delete')->setName('deleteAbsenceTypeDetail');
        });
        /* Collection */
        $this->get('', $typeNS . ':get')->setName('getAbsenceTypeListe');
        $this->post('', $typeNS . ':post')->setName('postAbsenceTypeListe');
    });
});
