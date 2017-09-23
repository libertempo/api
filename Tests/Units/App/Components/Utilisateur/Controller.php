<?php
namespace Tests\Units\App\Components\Utilisateur;

/**
 * Classe de test du contrôleur d'utilisateur
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.4
 */
final class Controller extends \Tests\Units\App\Libraries\ARestController
{
    protected function initRepository()
    {
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->repository = new \mock\App\Components\Utilisateur\Repository();
    }

    protected function initModel()
    {
        $this->mockGenerator->orphanize('__construct');
        $this->model = new \mock\App\Components\Utilisateur\Model();
        $this->model->getMockController()->getId = 42;
        $this->model->getMockController()->getToken = 12;
        $this->model->getMockController()->getLogin = 12;
        $this->model->getMockController()->getNom = 12;
        $this->model->getMockController()->getDateInscription = 12;
    }

    protected function getOne()
    {
        return $this->testedInstance->get($this->request, $this->response, ['utilisateurId' => 99,]);
    }

    protected function getList()
    {
        return $this->testedInstance->get($this->request, $this->response, []);
    }
}
