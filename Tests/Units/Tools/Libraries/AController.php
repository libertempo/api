<?php
namespace LibertAPI\Tests\Units\Tools\Libraries;

use Psr\Http\Message\ResponseInterface as IResponse;

/**
 * Classe de base des tests sur les contrôleurs
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.1
 */
abstract class AController extends \Atoum
{
    /**
     * @var \Slim\Http\Request Mock de la requête HTTP
     */
    protected $request;

    /**
     * @var \Slim\Http\Response Mock de la réponse HTTP
     */
    protected $response;

    /**
     * @var \Slim\Slim\Router Mock du routeur
     */
    protected $router;

    /**
     * @var \App\Libraries\ARepository Mock du repository associé
     */
    protected $repository;

    /**
     * @var \App\Libraries\AModel Mock du modèle associé
     */
    protected $model;

    /**
     * Init des tests
     */
    public function beforeTestMethod($method)
    {
        parent::beforeTestMethod($method);
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->request = new \mock\Slim\Http\Request();
        $this->response = new \mock\Slim\Http\Response();
        $this->router = new \mock\Slim\Router();
        $this->initRepository();
        $this->initModel();
    }

    abstract protected function initRepository();

    abstract protected function initModel();

    /*************************************************
     * GET
     *************************************************/

    /**
     * Teste la méthode get d'un détail trouvé
     */
    public function testGetOneFound()
    {
        $this->repository->getMockController()->getOne = $this->model;
        $this->newTestedInstance($this->repository, $this->router);

        $response = $this->getOne();
        $data = $this->getJsonDecoded($response->getBody());

        $this->integer($response->getStatusCode())->isIdenticalTo(200);
        $this->array($data)
            ->integer['code']->isIdenticalTo(200)
            ->string['status']->isIdenticalTo('success')
            ->string['message']->isIdenticalTo('')
            ->array['data']->isNotEmpty()
        ;
    }

    /**
     * Teste la méthode get d'un détail non trouvé
     */
    public function testGetOneNotFound()
    {
        $this->repository->getMockController()->getOne = function () {
            throw new \DomainException('');
        };
        $this->newTestedInstance($this->repository, $this->router);

        $response = $this->getOne();

        $this->assertError($response, 404);
    }

    /**
     * Teste le fallback de la méthode get d'un détail
     */
    public function testGetOneFallback()
    {
        $this->repository->getMockController()->getOne = function () {
            throw new \Exception('');
        };
        $this->newTestedInstance($this->repository, $this->router);

        $this->exception(function () {
            $this->getOne();
        })->isInstanceOf(\Exception::class);
    }

    abstract protected function getOne();

    /**
     * Teste la méthode get d'une liste trouvée
     */
    public function testGetListFound()
    {
        $this->request->getMockController()->getQueryParams = [];
        $this->repository->getMockController()->getList = [
            42 => $this->model,
        ];
        $this->newTestedInstance($this->repository, $this->router);

        $response = $this->getList();
        $data = $this->getJsonDecoded($response->getBody());

        $this->integer($response->getStatusCode())->isIdenticalTo(200);
        $this->array($data)
            ->integer['code']->isIdenticalTo(200)
            ->string['status']->isIdenticalTo('success')
            ->string['message']->isIdenticalTo('')
            //->array['data']->hasSize(1) // TODO: l'asserter atoum en sucre syntaxique est buggé, faire un ticket
        ;
        $this->array($data['data'][0])->hasKey('id');
    }

    /**
     * Teste la méthode get d'une liste non trouvée
     */
    public function testGetListNotFound()
    {
        $this->request->getMockController()->getQueryParams = [];
        $this->repository->getMockController()->getList = function () {
            throw new \UnexpectedValueException('');
        };
        $this->newTestedInstance($this->repository, $this->router);

        $response = $this->getList();

        $this->assertError($response, 404);
    }

    /**
     * Teste le fallback de la méthode get d'une liste
     */
    public function testGetListFallback()
    {
        $this->request->getMockController()->getQueryParams = [];
        $this->repository->getMockController()->getList = function () {
            throw new \Exception('');
        };
        $this->newTestedInstance($this->repository, $this->router);

        $this->exception(function () {
            $this->getList();
        })->isInstanceOf('\Exception');
    }

    abstract protected function getList();

    /**
     * Retourne le json décodé
     *
     * @param string $json
     *
     * @return array | mixed si le json est mal formé
     */
    protected function getJsonDecoded($json)
    {
        return json_decode((string) $json, true);
    }

    /**
     * Lance un pool d'assertion d'erreur
     *
     * @param IResponse $response Réponse Http
     * @param int $code Code d'erreur Http attendu
     */
    protected function assertError(IResponse $response, $code)
    {
        $data = $this->getJsonDecoded($response->getBody());

        $this->integer($response->getStatusCode())->isIdenticalTo($code);
        $this->array($data)
            ->integer['code']->isIdenticalTo($code)
            ->string['status']->isIdenticalTo('error')
            ->string['message']->isNotEqualTo('')
            ->array['data']->isNotEmpty()
        ;
    }

    /**
     * Lance un pool d'assertion vide
     *
     * @param IResponse $response Réponse Http
     * @param int $code Code Http attendu
     */
    protected function assertSuccessEmpty(IResponse $response)
    {
        $data = $this->getJsonDecoded($response->getBody());

        $this->integer($response->getStatusCode())->isIdenticalTo(204);
        $this->array($data)
            ->integer['code']->isIdenticalTo(204)
            ->string['status']->isIdenticalTo('success')
            ->string['message']->isEqualTo('No Content')
        ;
    }
}
