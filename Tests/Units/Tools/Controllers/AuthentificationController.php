<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Tools\Controllers;

use LibertAPI\Tools\Exceptions\AuthentificationFailedException;

/**
 * Classe de test du contrôleur d'authentification
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 */
final class AuthentificationController extends \LibertAPI\Tests\Units\Tools\Libraries\AController
{
    /**
     * @var LibertAPI\Tools\Libraries\StorageConfiguration Mock de la configuration
     */
    private $configuration;

    /**
     * Init des tests
     */
    public function beforeTestMethod($method)
    {
        parent::beforeTestMethod($method);
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->configuration = new \mock\LibertAPI\Tools\Libraries\StorageConfiguration();
        $this->calling($this->configuration)->isLdapConnection = false;
    }

    protected function initRepository()
    {
        $this->mockGenerator->orphanize('__construct');
        $this->repository = new \mock\LibertAPI\Utilisateur\UtilisateurRepository();
    }

    protected function initEntite()
    {
        $this->mockGenerator->orphanize('__construct');
        $this->entite = new \mock\LibertAPI\Utilisateur\UtilisateurEntite();
        $this->entite->getMockController()->getId = 42;
        $this->entite->getMockController()->getToken = 12;
        $this->entite->getMockController()->getLogin = 12;
        $this->entite->getMockController()->getNom = 12;
        $this->entite->getMockController()->getDateInscription = 12;
        $this->entite->getMockController()->getMotDePasse = 'Fatboy slim';
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
        $this->newTestedInstance($this->repository, $this->router, $this->configuration);

        $response = $this->testedInstance->get($this->request, $this->response, []);

        $this->assertFail($response, 400);
    }

    /**
     * Teste la méthode get d'une authentification non réussie
     */
    public function testGetNotFound()
    {
        $this->repository->getMockController()->find = function () {
            throw new AuthentificationFailedException('');
        };
        $this->request->getMockController()->getHeaderLine = 'Basic QWxhZGRpbjpPcGVuU2VzYW1l';
        $this->newTestedInstance($this->repository, $this->router, $this->configuration);

        $response = $this->testedInstance->get(
            $this->request,
            $this->response,
            []
        );

        $this->assertFail($response, 404);
    }

    /**
     * Teste la méthode get d'une authentification échouée avec mauvais mdp
     */
    public function testGetWrongPassword()
    {
        $this->entite->getMockController()->isPasswordMatching = false;
        $this->repository->getMockController()->find = $this->entite;
        $this->request->getMockController()->getHeaderLine = 'Basic QWxhZGRpbjpPcGVuU2VzYW1l';
        $this->newTestedInstance($this->repository, $this->router, $this->configuration);

        $response = $this->testedInstance->get(
            $this->request,
            $this->response,
            []
        );

        $this->assertFail($response, 404);
    }

    /**
     * Teste la méthode get d'une authentification réussie
     */
    public function testGetFound()
    {
        $token = 'abcde';
        $this->entite->getMockController()->getToken = $token;
        $this->entite->getMockController()->isPasswordMatching = true;
        $this->repository->getMockController()->find = $this->entite;
        $this->repository->getMockController()->regenerateToken = $this->entite;
        $this->request->getMockController()->getHeaderLine = 'Basic QWxhZGRpbjpPcGVuU2VzYW1l';
        $this->newTestedInstance($this->repository, $this->router, $this->configuration);

        $response = $this->testedInstance->get($this->request, $this->response, []);
        $data = $this->getJsonDecoded($response->getBody());

        $this->integer($response->getStatusCode())->isIdenticalTo(200);
        $this->array($data)
            ->integer['code']->isIdenticalTo(200)
            ->string['status']->isIdenticalTo('success')
            ->string['data']->isIdenticalTo($token)
        ;
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
