<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Controllers;

use LibertAPI\Tools\Interfaces;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;
use \Slim\Interfaces\RouterInterface as IRouter;
use LibertAPI\Solde;

/**
 * Contrôleur du solde de l'employé courant
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina <wouldsmina@gmail.com>
 *
 * @since 1.9
 */
final class SoldeEmployeController extends \LibertAPI\Tools\Libraries\AController
implements Interfaces\IGetable
{
    public function __construct(Solde\SoldeRepository $repository, IRouter $router)
    {
        parent::__construct($repository, $router);
    }

    /**
     * {@inheritDoc}
     */
    public function get(IRequest $request, IResponse $response, array $arguments) : IResponse
    {
        unset($arguments);
        return $this->getList($request, $response);
    }

    /**
     * Retourne un tableau des soldes
     */
    private function getList(IRequest $request, IResponse $response) : IResponse
    {
        $user = $request->getAttribute('currentUser');
        $arguments = array_merge($request->getQueryParams(), ['login' => $user->getLogin()]);
        try {
            $responseResources = $this->repository->getList($arguments);
        } catch (\UnexpectedValueException $e) {
            return $this->getResponseNoContent($response);
        } catch (\Exception $e) {
            return $this->getResponseError($response, $e);
        }
        $entites = array_map([$this, 'buildData'], $responseResources);

        return $this->getResponseSuccess($response, $entites, 200);
    }

    /**
     * Construit le « data » du json
     */
    private function buildData(Solde\SoldeEntite $entite) : array
    {
        return [
            'login' => $entite->getLogin(),
            'type_absence' => $entite->getTypeAbsence(),
            'solde_annuel' => $entite->getSoldeAn(),
            'solde' => $entite->getSolde(),
            'reliquat' => $entite->getReliquat(),
        ];
    }
}
