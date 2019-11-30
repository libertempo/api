<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Tools\Controllers;

use LibertAPI\Utilisateur\UtilisateurEntite;

/**
 * Classe de test du contrôleur de journal
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.5
 */
final class JournalController extends \LibertAPI\Tests\Units\Tools\Libraries\AController
{
    /**
     * {@inheritdoc}
     */
    protected function initRepository()
    {
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->repository = new \mock\LibertAPI\Journal\JournalRepository();
    }

    /**
     * {@inheritdoc}
     */
    protected function initEntite()
    {
        $this->entite = new \LibertAPI\Journal\JournalEntite([
            'id' => 42,
            'numeroPeriode' => 88,
            'utilisateurActeur' => '4',
            'utilisateurObjet' => '8',
            'etat' => 'cassé',
            'commentaire' => 'c\'est cassé',
            'date' => 'now',
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
        $this->boolean(empty($data['data']))->isFalse();
    }

    /**
     * Teste la méthode get d'une liste vide
     */
    public function testGetNoContent()
    {
        $repository = $this->entityManager->getRepository('');
        $repository->getMockController()->findAll = [];
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
