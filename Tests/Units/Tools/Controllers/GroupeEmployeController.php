<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Tools\Controllers;

use LibertAPI\Groupe\Entite;

/**
 * Classe de test du contrôleur d'un employé de groupe
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.0
 */
final class GroupeEmployeController extends \LibertAPI\Tests\Units\Tools\Libraries\AController
{
    /**
     * {@inheritdoc}
     */
    protected function initRepository()
    {
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->repository = new \mock\LibertAPI\Groupe\Employe\EmployeRepository();
    }

    /**
     * {@inheritdoc}
     */
    protected function initEntite()
    {
        $this->entite = new Entite();
        $this->entite->setName(97323);
        $this->entite->setDoubleValid(false);
    }

    /*************************************************
     * GET
     *************************************************/

    /**
     * Teste la méthode get d'une liste trouvée
     */
    public function testGetFound()
    {
        $repository = $this->entityManager->getRepository('');
        $employe = new \LibertAPI\Utilisateur\Entite();
        $employe->setLogin('test');
        $this->entite->addEmployeGroupe($employe);
        $this->calling($repository)->find = $this->entite;
        $this->newTestedInstance($this->repository, $this->router, $this->entityManager);
        $response = $this->testedInstance->get($this->request, $this->response, ['groupeId' => 32]);
        $data = $this->getJsonDecoded($response->getBody());

        $this->integer($response->getStatusCode())->isIdenticalTo(200);
        $this->array($data)
            ->integer['code']->isIdenticalTo(200)
            ->string['status']->isIdenticalTo('success')
            ->string['message']->isIdenticalTo('OK')
            //->array['data']->hasSize(1) // TODO: l'asserter atoum en sucre syntaxique est buggé, faire un ticket
        ;
        $this->array($data['data'][0])->hasKey('login');
    }

    /**
     * Teste la méthode get d'une liste non trouvée
     */
    public function testGetNotFound()
    {
        $repository = $this->entityManager->getRepository('');
        $this->calling($repository)->find = $this->entite;
        $this->newTestedInstance($this->repository, $this->router, $this->entityManager);
        $response = $this->testedInstance->get($this->request, $this->response, ['groupeId' => 25]);

        $this->assertSuccessEmpty($response);
    }

    /**
     * Teste le fallback de la méthode get d'une liste
     */
    public function testGetFallback()
    {
        $repository = $this->entityManager->getRepository('');
        $this->calling($repository)->find = function () {
            throw new \Exception('');
        };
        $this->newTestedInstance($this->repository, $this->router, $this->entityManager);

        $response = $this->testedInstance->get($this->request, $this->response, ['groupeId' => 85]);
        $this->assertError($response);
    }
}
