<?php

$app->group('/heures/HautResponsable/Repos', function () {
    $heureNS = '\LibertAPI\Heure\HautResponsable\Repos\ReposController';
    $this->get('', $heureNS . ':get')->setName('getHeureList');
});