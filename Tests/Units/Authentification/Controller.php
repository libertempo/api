<?php
namespace LibertAPI\Tests\Units\Authentification;

use LibertAPI\Authentification\Controller as _Controller;

/**
 * Classe de test du contrôleur de planning
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 */
final class Controller extends \LibertAPI\Tests\Units\Tools\Libraries\AController
{
    /**
     * @var \LibertAPI\Utilisateur\Repository Mock du repository associé
     */
    private $repository;

    /**
     * @var \LibertAPI\Utilisateur\Entite Mock de l'entité associée
     */
    private $entite;

    /**
     * Init des tests
     */
    public function beforeTestMethod($method)
    {
        parent::beforeTestMethod($method);
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->repository = new \mock\LibertAPI\Utilisateur\Repository();
        $this->mockGenerator->orphanize('__construct');
        $this->entite = new \mock\LibertAPI\Utilisateur\Entite();
    }

    /*************************************************
     * GET
     *************************************************/

    /**
     * Teste la méthode avec un mauvais header
     */
    public function testGetBadAuthentificationMechanism()
    {
        // Le framework fait du traitement, un mauvais json est simplement null
        $this->request->getMockController()->getHeaderLine = 'NotBasic';
        $controller = new _Controller($this->repository, $this->router);

        $response = $controller->get($this->request, $this->response);

        $this->assertError($response, 400);
    }

    /**
     * Teste la méthode get d'une authentification non réussie
     */
    public function testGetNotFound()
    {
        $this->repository->getMockController()->find = function () {
            throw new \UnexpectedValueException('');
        };
        $this->request->getMockController()->getHeaderLine = 'Basic QWxhZGRpbjpPcGVuU2VzYW1l';
        $controller = new _Controller($this->repository, $this->router);

        $response = $controller->get(
            $this->request,
            $this->response
        );

        $this->assertError($response, 404);
    }

    /**
     * Teste la méthode get d'une authentification réussie
     */
    public function testGetFound()
    {
        $token = 'abcde';
        $this->entite->getMockController()->getToken = $token;
        $this->repository->getMockController()->find = $this->entite;
        $this->repository->getMockController()->regenerateToken = $this->entite;
        $this->request->getMockController()->getHeaderLine = 'Basic QWxhZGRpbjpPcGVuU2VzYW1l';
        $controller = new _Controller($this->repository, $this->router);

        $response = $controller->get($this->request, $this->response);
        $data = $this->getJsonDecoded($response->getBody());

        $this->integer($response->getStatusCode())->isIdenticalTo(200);
        $this->array($data)
            ->integer['code']->isIdenticalTo(200)
            ->string['status']->isIdenticalTo('success')
            ->string['message']->isIdenticalTo('')
            ->string['data']->isIdenticalTo($token)
        ;
    }
}
