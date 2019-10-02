<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Tools\Libraries;

use LibertAPI\Utilisateur\UtilisateurEntite;
use Psr\Http\Message\ResponseInterface as IResponse;
use \LibertAPI\Tools\Exceptions\UnknownResourceException;

/**
 * Classe de base des tests sur les contrôleurs REST
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.4
 */
abstract class ARestController extends AController
{
    /**
     * @var UtilisateurEntite Standardisation d'un rôle responsable
     */
    protected $currentResponsable;

    /*************************************************
     * GET
     *************************************************/

    /**
     * Teste la méthode get d'un détail trouvé
     */
    public function testGetOneFound()
    {
        $this->entityManager->getMockController()->find = $this->entite;
        $this->newTestedInstance($this->repository, $this->router, $this->entityManager);

        $response = $this->getOne();
        
        $data = $this->getJsonDecoded($response->getBody());
        $this->integer($response->getStatusCode())->isIdenticalTo(200);
        $this->array($data)
            ->integer['code']->isIdenticalTo(200)
            ->string['status']->isIdenticalTo('success')
            ->array['data']->isNotEmpty()
        ;
    }

    /**
     * Teste la méthode get d'un détail non trouvé
     */
    public function testGetOneNotFound()
    {
        $this->entityManager->getMockController()->find = null;
        $this->newTestedInstance($this->repository, $this->router, $this->entityManager);

        $response = $this->getOne();

        $this->assertFail($response, 404);
    }

    /**
     * Teste le fallback de la méthode get d'un détail
     */
    public function testGetOneFallback()
    {
        $this->entityManager->getMockController()->find = function () {
            throw new \Exception('');
        };
        $this->newTestedInstance($this->repository, $this->router, $this->entityManager);

        $response = $this->getOne();
        $response = $this->assertError($response);
    }

    abstract protected function getOne() : IResponse;

    /**
     * Teste la méthode get d'une liste trouvée
     */
    public function testGetListFound()
    {
        $this->entityRepository->getMockController()->findAll = [$this->entite,];
        $this->newTestedInstance($this->repository, $this->router, $this->entityManager);

        $response = $this->getList();

        $data = $this->getJsonDecoded($response->getBody());
        $this->integer($response->getStatusCode())->isIdenticalTo(200);
        $this->array($data)
            ->integer['code']->isIdenticalTo(200)
            ->string['status']->isIdenticalTo('success')
            //->array['data']->hasSize(1) // TODO: l'asserter atoum en sucre syntaxique est buggé, faire un ticket
        ;
        $this->boolean(empty($data['data']))->isFalse();
    }

    /**
     * Teste la méthode get d'une liste vide
     */
    public function testGetListNoContent()
    {
        $this->entityRepository->getMockController()->findAll = function () {
            throw new \UnexpectedValueException('');
        };
        $this->newTestedInstance($this->repository, $this->router, $this->entityManager);

        $response = $this->getList();

        $this->assertSuccessEmpty($response);
    }

    /**
     * Teste le fallback de la méthode get d'une liste
     */
    public function testGetListFallback()
    {
        $this->entityRepository->getMockController()->findAll = function () {
            throw new \Exception('');
        };
        $this->newTestedInstance($this->repository, $this->router, $this->entityManager);

        $response = $this->getList();
        $this->assertError($response);
    }

    abstract protected function getList() : IResponse;

    abstract protected function getEntiteContent() : array;
}
