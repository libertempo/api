<?php
namespace LibertAPI\Absence\Type;

use LibertAPI\Tools\Libraries\AEntite;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.5
 * @see \Tests\Units\Absence\Type\TypeRepository
 */
class TypeRepository extends \LibertAPI\Tools\Libraries\ARepository
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
            throw new \DomainException('Type#' . $id . ' is not a valid resource');
        }

        return new TypeEntite($this->getDataDao2Entite($data));
    }

    /**
     * @inheritDoc
     */
    public function getList(array $parametres)
    {
        $data = $this->dao->getList($this->getParamsConsumer2Dao($parametres));
        if (empty($data)) {
            throw new \UnexpectedValueException('No resource match with these parameters');
        }

        $entites = [];
        foreach ($data as $value) {
            $entite = new TypeEntite($this->getDataDao2Entite($value));
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
     * {@inheritDoc}
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

    /**
     * @inheritDoc
     */
    public function postOne(array $data, AEntite $entite)
    {
    }

    /**
     * @inheritDoc
     */
    final protected function getEntite2DataDao(AEntite $entite)
    {}

    /**
     * @inheritDoc
     */
    public function putOne(array $data, AEntite $entite)
    {
    }

    /**
     * @inheritDoc
     */
    public function deleteOne(AEntite $entite)
    {
    }
}
