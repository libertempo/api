<?php

$app->group('/heures', function () {
    $heureNS = '\LibertAPI\Heure\HautResponsable\Repos\HeureController';
    $this->get('', $heureNS . ':get')->setName('getHeureList');
});