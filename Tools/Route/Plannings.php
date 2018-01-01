<?php
/*
 * Doit être importé après la création de $app. Ne créé rien.
 *
 * La convention de nommage est de mettre les routes au pluriel
 */

/* Routes sur le planning et associés */
$app->group('/plannings', function () {
    $this->group('/{planningId:[0-9]+}', function () {
        /* Detail */
        $this->get('', 'controller:get')->setName('getPlanningDetail');
        $this->put('', 'controller:put')->setName('putPlanningDetail');
        $this->delete('', 'controller:delete')->setName('deletePlanningDetail');

        /* Dependances de plannings */
        $this->group('/creneaux', function () {
            /* Detail creneaux */
            $this->get('/{creneauId:[0-9]+}', 'controller:get')->setName('getPlanningCreneauDetail');
            $this->put('/{creneauId:[0-9]+}', 'controller:put')->setName('putPlanningCreneauDetail');
            //$this->delete('/{creneauId:[0-9]+}', $creneauNS . ':delete')->setName('deletePlanningCreneauDetail');

            /* Collection creneaux */
            $this->get('', 'controller:get')->setName('getPlanningCreneauListe');
            $this->post('', 'controller:post')->setName('postPlanningCreneauListe');
        });
    });

    /* Collection */
    $this->get('', 'controller:get')->setName('getPlanningListe');
    $this->post('', 'controller:post')->setName('postPlanningListe');
});
