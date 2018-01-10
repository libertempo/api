<?php

$app->group('/heure', function () {
    $this->group('/hautresponsable', function () {
        $this->group('/repos', function () {
            $this->group('/{reposId:[0-9]+}', function () {
                $this->get('', 'controller:get')->setName('getHeureReposDetail');
            });
            $this->get('', 'controller:get')->setName('getHeureReposListe');
        });
    });
});