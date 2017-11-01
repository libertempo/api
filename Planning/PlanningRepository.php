<?php
namespace LibertAPI\Planning;

use LibertAPI\Tools\Exceptions\MissingArgumentException;
use LibertAPI\Tools\Libraries\AEntite;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.1
 * @see \Tests\Units\Planning\Repository
 *
 * Ne devrait être contacté que par le Planning\Controller
 * Ne devrait contacter que le Planning\Entite, Planning\Dao
 */
class PlanningRepository extends \LibertAPI\Tools\Libraries\ARepository
{
    /*************************************************
     * GET
     *************************************************/

    /**
     * @inheritDoc
     */
    public function getOne($id)
    {
        $id = (int) $id;
        $data = $this->dao->getById($id);
        if (empty($data)) {
            throw new \DomainException('Planning#' . $id . ' is not a valid resource');
        }

        return new PlanningEntite($this->getDataDao2Entite($data));
    }

    /**
     * @inheritDoc
     */
    public function getList(array $parametres)
    {
        /* TODO: retourner une collection pour avoir le total, hors limite forcée (utile pour la pagination) */
        /*
        several params :
        offset (first, !isset => 0) / start-after ?
        Limit (nb elements)
        filter (dimensions forced)
        */
        $data = $this->dao->getList($this->getParamsConsumer2Dao($parametres));
        if (empty($data)) {
            throw new \UnexpectedValueException('No resource match with these parameters');
        }

        $entites = [];
        foreach ($data as $value) {
            $entite = new PlanningEntite($this->getDataDao2Entite($value));
            $entites[$entite->getId()] = $entite;
        }

        return $entites;
    }

    /**
     * @inheritDoc
     */
    final protected function getDataDao2Entite(array $dataDao)
    {
        return [
            'id' => $dataDao['planning_id'],
            'name' => $dataDao['name'],
            'status' => $dataDao['status'],
        ];
    }

    /**
     * @inheritDoc
     */
    final protected function getParamsConsumer2Dao(array $paramsConsumer)
    {
        $filterInt = function ($var) {
            return filter_var(
                $var,
                FILTER_VALIDATE_INT,
                ['options' => ['min_range' => 1]]
            );
        };
        $results = [];
        if (!empty($paramsConsumer['limit'])) {
            $results['limit'] = $filterInt($paramsConsumer['limit']);
        }
        if (!empty($paramsConsumer['start-after'])) {
            $results['lt'] = $filterInt($paramsConsumer['start-after']);

        }
        if (!empty($paramsConsumer['start-before'])) {
            $results['gt'] = $filterInt($paramsConsumer['start-before']);
        }
        return $results;
    }

    /*************************************************
     * POST
     *************************************************/

    /**
     * @inheritDoc
     */
    final protected function getEntite2DataDao(AEntite $entite)
    {
        return [
            'name' => $entite->getName(),
            'status' => $entite->getStatus(),
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function getListRequired()
    {
        return ['name', 'status'];
    }

    /*************************************************
     * DELETE
     *************************************************/

    /**
     * @inheritDoc
     */
    public function deleteOne(AEntite $entite)
    {
        try {
            $entite->reset();
            $this->dao->delete($entite->getId());
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
