<?php
namespace LibertAPI\Absence\Type;

use LibertAPI\Tools\Interfaces;
use Psr\Http\Message\ServerRequestInterface as IRequest;
use Psr\Http\Message\ResponseInterface as IResponse;

/**
 * Contrôleur de type d'absence
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.5
 * @see \Tests\Units\Absence\Type\TypeController
 */
final class TypeController extends \LibertAPI\Tools\Libraries\AController
implements Interfaces\IGetable
{
    /**
     * {@inheritDoc}
     */
    public function get(IRequest $request, IResponse $response, array $arguments)
    {
        if (!isset($arguments['typeId'])) {
            return $this->getList($request, $response);
        }

        return $this->getOne($response, (int) $arguments['typeId']);
    }

    /**
     * Retourne un élément unique
     *
     * @param IResponse $response Réponse Http
     * @param int $id ID de l'élément
     *
     * @return IResponse, 404 si l'élément n'est pas trouvé, 200 sinon
     * @throws \Exception en cas d'erreur inconnue (fallback, ne doit pas arriver)
     */
    private function getOne(IResponse $response, $id)
    {
        try {
            $planning = $this->repository->getOne($id);
            $code = 200;
            $data = [
                'code' => $code,
                'status' => 'success',
                'message' => '',
                'data' => $this->buildData($planning),
            ];

            return $response->withJson($data, $code);
        } catch (\DomainException $e) {
            return $this->getResponseNotFound($response, 'Element « plannings#' . $id . ' » is not a valid resource');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Retourne un tableau de plannings
     *
     * @param IRequest $request Requête Http
     * @param IResponse $response Réponse Http
     *
     * @return IResponse
     * @throws \Exception en cas d'erreur inconnue (fallback, ne doit pas arriver)
     */
    private function getList(IRequest $request, IResponse $response)
    {
        try {
            $plannings = $this->repository->getList(
                $request->getQueryParams()
            );
            $entites = [];
            foreach ($plannings as $planning) {
                $entites[] = $this->buildData($planning);
            }
            $code = 200;
            $data = [
                'code' => $code,
                'status' => 'success',
                'message' => '',
                'data' => $entites,
            ];

            return $response->withJson($data, $code);
        } catch (\UnexpectedValueException $e) {
            return $this->getResponseNoContent($response);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Construit le « data » du json
     *
     * @param TypeEntite $entite Type
     *
     * @return array
     */
    private function buildData(TypeEntite $entite)
    {
        return [
            'id' => $entite->getId(),
            'type' => $entite->getType(),
            'libelle' => $entite->getLibelle(),
            'libelleCourt' => $entite->getLibelleCourt(),
        ];
    }
}
