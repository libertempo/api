<?php
namespace LibertAPI\Tests\Units\Absence\Type;

/**
 * Classe de test du contrôleur des type d'absence
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.5
 */
final class TypeController extends \LibertAPI\Tests\Units\Tools\Libraries\AController
{
    /**
     * @var \LibertAPI\Tools\Libraries\ARepository Mock du repository associé
     */
    private $repository;

    /**
     * @var \LibertAPI\Tools\Libraries\AEntite Mock de l'entité associée
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
        $this->repository = new \mock\LibertAPI\Absence\Type\TypeRepository();
        $this->mockGenerator->orphanize('__construct');
        $this->entite = new \LibertAPI\Absence\Type\TypeEntite([
            'id' => 42,
            'type' => 'thieft',
            'libelle' => 'GTA',
            'libelleCourt' => 'vice'
        ]);
    }

    /*************************************************
     * GET
     *************************************************/

    /**
     * Teste la méthode get d'un détail trouvé
     */
    public function testGetOneFound()
    {
        $this->repository->getMockController()->getOne = $this->entite;
        $this->newTestedInstance($this->repository, $this->router);
        $response = $this->testedInstance->get($this->request, $this->response, ['typeId' => 99]);
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
        $response = $this->testedInstance->get($this->request, $this->response, ['typeId' => 99]);

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

        $this->exception(function () {
            $this->newTestedInstance($this->repository, $this->router);
            $this->testedInstance->get($this->request, $this->response, ['typeId' => 99]);
        })->isInstanceOf('\Exception');
    }

    /**
     * Teste la méthode get d'une liste trouvée
     */
    public function testGetListFound()
    {
        $this->request->getMockController()->getQueryParams = [];
        $this->repository->getMockController()->getList = [
            42 => $this->entite,
        ];
        $this->newTestedInstance($this->repository, $this->router);
        $response = $this->testedInstance->get($this->request, $this->response, []);
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
        $response = $this->testedInstance->get($this->request, $this->response, []);

        $this->assertSuccessEmpty($response);
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

        $this->exception(function () {
            $this->newTestedInstance($this->repository, $this->router);
            $this->testedInstance->get($this->request, $this->response, []);
        })->isInstanceOf('\Exception');
    }

    /*************************************************
     * POST
     *************************************************/

    /**
     * Teste la méthode post d'un json mal formé
     */
    public function testPostJsonBadFormat()
    {
        // Le framework fait du traitement, un mauvais json est simplement null
        $this->request->getMockController()->getParsedBody = null;
        $this->newTestedInstance($this->repository, $this->router);
        $response = $this->testedInstance->post($this->request, $this->response, []);

        $this->assertError($response, 400);
    }

    /**
     * Teste la méthode post avec un argument de body manquant
     */
    public function testPostMissingRequiredArg()
    {
        $this->request->getMockController()->getParsedBody = [];
        $this->repository->getMockController()->postOne = function () {
            throw new \LibertAPI\Tools\Exceptions\MissingArgumentException('');
        };
        $this->newTestedInstance($this->repository, $this->router);
        $response = $this->testedInstance->post($this->request, $this->response, []);

        $this->assertError($response, 412);
    }

    /**
     * Teste la méthode post avec un argument de body incohérent
     */
    public function testPostBadDomain()
    {
        $this->request->getMockController()->getParsedBody = [];
        $this->repository->getMockController()->postOne = function () {
            throw new \DomainException('Status doit être un int');
        };
        $this->newTestedInstance($this->repository, $this->router);
        $response = $this->testedInstance->post($this->request, $this->response, []);

        $this->assertError($response, 412);
    }

    /**
     * Teste la méthode post Ok
     */
    public function testPostOk()
    {
        $this->request->getMockController()->getParsedBody = [];
        $this->router->getMockController()->pathFor = '';
        $this->repository->getMockController()->postOne = 42;
        $this->newTestedInstance($this->repository, $this->router);
        $response = $this->testedInstance->post($this->request, $this->response, []);
        $data = $this->getJsonDecoded($response->getBody());

        $this->integer($response->getStatusCode())->isIdenticalTo(201);
        $this->array($data)
            ->integer['code']->isIdenticalTo(201)
            ->string['status']->isIdenticalTo('success')
            ->string['message']->isIdenticalTo('')
            ->array['data']->isNotEmpty()
        ;
    }

    /**
     * Teste le fallback de la méthode post
     */
    public function testPostFallback()
    {
        $this->request->getMockController()->getParsedBody = [];
        $this->repository->getMockController()->postOne = function () {
            throw new \Exception('');
        };

        $this->exception(function () {
            $this->newTestedInstance($this->repository, $this->router);
            $this->testedInstance->post($this->request, $this->response, []);
        })->isInstanceOf('\Exception');
    }

    /*************************************************
     * PUT
     *************************************************/

    /**
     * Teste la méthode put d'un json mal formé
     */
    public function testPutJsonBadFormat()
    {
        // Le framework fait du traitement, un mauvais json est simplement null
        $this->request->getMockController()->getParsedBody = null;
        $this->newTestedInstance($this->repository, $this->router);
        $response = $this->testedInstance->put($this->request, $this->response, ['typeId' => 99]);

        $this->assertError($response, 400);
    }

    /**
     * Teste la méthode put avec un détail non trouvé (id en Bad domaine)
     */
    public function testPutNotFound()
    {
        $this->request->getMockController()->getParsedBody = [];
        $this->repository->getMockController()->getOne = function () {
            throw new \DomainException('');
        };
        $this->newTestedInstance($this->repository, $this->router);
        $response = $this->testedInstance->put($this->request, $this->response, ['typeId' => 99]);

        $this->boolean($response->isNotFound())->isTrue();
    }

    /**
     * Teste le fallback de la méthode getOne du put
     */
    public function testPutGetOneFallback()
    {
        $this->request->getMockController()->getParsedBody = [];
        $this->repository->getMockController()->getOne = function () {
            throw new \LogicException('');
        };

        $this->exception(function () {
            $this->newTestedInstance($this->repository, $this->router);
            $this->testedInstance->put($this->request, $this->response, ['typeId' => 99]);
        })->isInstanceOf('\Exception');
    }

    /**
     * Teste la méthode put avec un argument de body manquant
     */
    public function testPutMissingRequiredArg()
    {
        $this->request->getMockController()->getParsedBody = [];
        $this->repository->getMockController()->getOne = $this->entite;

        $this->repository->getMockController()->putOne = function () {
            throw new \LibertAPI\Tools\Exceptions\MissingArgumentException('');
        };
        $this->newTestedInstance($this->repository, $this->router);
        $response = $this->testedInstance->put($this->request, $this->response, ['typeId' => 99]);

        $this->assertError($response, 412);
    }

    /**
     * Teste la méthode put avec un argument de body incohérent
     */
    public function testPutBadDomain()
    {
        $this->request->getMockController()->getParsedBody = [];
        $this->repository->getMockController()->getOne = $this->entite;
        $this->repository->getMockController()->putOne = function () {
            throw new \DomainException('');
        };
        $this->newTestedInstance($this->repository, $this->router);
        $response = $this->testedInstance->put($this->request, $this->response, ['typeId' => 99]);

        $this->assertError($response, 412);
    }

    /**
     * Teste le fallback de la méthode putOne du put
     */
    public function testPutPutOneFallback()
    {
        $this->request->getMockController()->getParsedBody = [];
        $this->repository->getMockController()->getOne = $this->entite;
        $this->repository->getMockController()->putOne = function () {
            throw new \LogicException('');
        };

        $this->exception(function () {
            $this->newTestedInstance($this->repository, $this->router);
            $this->testedInstance->put($this->request, $this->response, ['typeId' => 99]);
        })->isInstanceOf('\Exception');
    }

    /**
     * Teste la méthode put Ok
     */
    public function testPutOk()
    {
        $this->request->getMockController()->getParsedBody = [];
        $this->repository->getMockController()->getOne = $this->entite;
        $this->repository->getMockController()->putOne = '';
        $this->newTestedInstance($this->repository, $this->router);
        $response = $this->testedInstance->put($this->request, $this->response, ['typeId' => 99]);

        $data = $this->getJsonDecoded($response->getBody());

        $this->integer($response->getStatusCode())->isIdenticalTo(204);
        $this->array($data)
            ->integer['code']->isIdenticalTo(204)
            ->string['status']->isIdenticalTo('success')
            ->string['message']->isIdenticalTo('')
            ->string['data']->isIdenticalTo('')
        ;
    }

    /*************************************************
     * DELETE
     *************************************************/

    /**
     * Teste la méthode delete avec un détail non trouvé (id en Bad domaine)
     */
    public function testDeleteNotFound()
    {
        $this->repository->getMockController()->getOne = function () {
            throw new \DomainException('');
        };
        $this->newTestedInstance($this->repository, $this->router);
        $response = $this->testedInstance->delete($this->request, $this->response, ['typeId' => 99]);

        $this->boolean($response->isNotFound())->isTrue();
    }

    /**
     * Teste le fallback de la méthode delete
     */
    public function testDeleteFallback()
    {
        $this->repository->getMockController()->getOne = function () {
            throw new \LogicException('');
        };

        $this->exception(function () {
            $this->newTestedInstance($this->repository, $this->router);
            $this->testedInstance->delete($this->request, $this->response, ['typeId' => 99]);
        })->isInstanceOf('\Exception');
    }

    /**
     * Teste la méthode delete Ok
     */
    public function testDeleteOk()
    {
        $this->repository->getMockController()->getOne = $this->entite;
        $this->newTestedInstance($this->repository, $this->router);
        $response = $this->testedInstance->delete($this->request, $this->response, ['typeId' => 99]);
        $data = $this->getJsonDecoded($response->getBody());

        $this->integer($response->getStatusCode())->isIdenticalTo(200);
        $this->array($data)
            ->integer['code']->isIdenticalTo(200)
            ->string['status']->isIdenticalTo('success')
            ->string['message']->isIdenticalTo('')
            ->array['data']->isNotEmpty()
        ;
    }
}
