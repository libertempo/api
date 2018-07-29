<?php declare(strict_types = 1);

use LibertAPI\Tools\Controllers\HeureHautResponsableReposController;

$app->group('/heure', function () {
    $this->group('/haut_responsable', function () {
        $this->group('/repos', function () {
            $this->group('/{reposId:[0-9]+}', function () {
                $this->get('', [HeureHautResponsableReposController::class, 'get'])->setName('getHeureReposDetail');
            });
            $this->get('', [HeureHautResponsableReposController::class, 'get'])->setName('getHeureReposListe');
        });
    });
});