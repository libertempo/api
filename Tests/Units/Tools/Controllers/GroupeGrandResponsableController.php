<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Tools\Controllers;

use LibertAPI\Groupe\GrandResponsable\GrandResponsableEntite;

/**
 * Classe de test du contrôleur de grand responsable de groupe
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.0
 */
final class GroupeGrandResponsableController extends \LibertAPI\Tests\Units\Tools\Libraries\AController
{
    /**
     * {@inheritdoc}
     */
    protected function initRepository()
    {
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->repository = new \mock\LibertAPI\Groupe\GrandResponsable\GrandResponsableRepository();
    }


    /**
     * {@inheritdoc}
     */
    protected function initEntite()
    {
        $this->entite = new GrandResponsableEntite([
            'id' => uniqid(),
            'groupeId' => 91823,
            'login' => 'Parker',
        ]);
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
        $repository->getMockController()->findAll = [$this->entite,];
        $this->newTestedInstance($this->repository, $this->router, $this->entityManager);
        $response = $this->testedInstance->get($this->request, $this->response, []);
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
        $this->calling($this->request)->getQueryParams = [];
        $this->calling($this->repository)->getList = function () {
            throw new \UnexpectedValueException('');
        };
        $this->newTestedInstance($this->repository, $this->router, $this->entityManager);
        $response = $this->testedInstance->get($this->request, $this->response, []);

        $this->assertSuccessEmpty($response);
    }

    /**
     * Teste le fallback de la méthode get d'une liste
     */
    public function testGetFallback()
    {
        $repository = $this->entityManager->getRepository('');
        $repository->getMockController()->findAll = function () {
            throw new \Exception('');
        };
        $this->newTestedInstance($this->repository, $this->router, $this->entityManager);

        $response = $this->testedInstance->get($this->request, $this->response, []);
        $this->assertError($response);
    }
}
