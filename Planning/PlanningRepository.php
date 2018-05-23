<?php declare(strict_types = 1);
namespace LibertAPI\Planning;

use LibertAPI\Tools\Libraries\AEntite;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.1
 * @see \LibertAPI\Tests\Units\Planning\PlanningRepository
 *
 * Ne devrait être contacté que par le PlanningController
 * Ne devrait contacter que le PlanningEntite
 */
class PlanningRepository extends \LibertAPI\Tools\Libraries\ARepository
{
    /**
     * @inheritDoc
     */
    public function getById(int $id) : AEntite
    {
        $this->queryBuilder->select('*');
        $this->setWhere(['id' => $id]);
        $res = $this->queryBuilder->execute();

        $data = $res->fetch(\PDO::FETCH_ASSOC);
        if (empty($data)) {
            throw new \DomainException('#' . $id . ' is not a valid resource');
        }

        return new PlanningEntite($this->getStorage2Entite($data));
    }

    /**
     * @inheritDoc
     */
    final protected function getParamsConsumer2Storage(array $paramsConsumer) : array
    {
        unset($paramsConsumer);
        return [];
    }

    /**
     * @inheritDoc
     */
    final protected function getStorage2Entite(array $dataStorage)
    {
        return [
            'id' => $dataStorage['planning_id'],
            'name' => $dataStorage['name'],
            'status' => $dataStorage['status'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function _getList(array $parametres) : array
    {
        $this->queryBuilder->select('*');
        $this->setWhere($parametres);
        $res = $this->queryBuilder->execute();

        $data = $res->fetchAll(\PDO::FETCH_ASSOC);
        if (empty($data)) {
            throw new \UnexpectedValueException('No resource match with these parameters');
        }

        $entites = [];
        foreach ($data as $value) {
            $entite = new PlanningEntite($this->getStorage2Entite($value));
            $entites[$entite->getId()] = $entite;
        }

        return $entites;
    }

    /**
     * @inheritDoc
     */
    public function _post(AEntite $entite) : int
    {
        $this->queryBuilder->insert($this->getTableName());
        $this->setValues($this->getEntite2Storage($entite));
        $this->queryBuilder->execute();

        return $this->storageConnector->lastInsertId();
    }

    /**
     * @inheritDoc
     */
    public function _put(AEntite $entite)
    {
        $this->queryBuilder->update($this->getTableName());
        $this->setSet($this->getEntite2Storage($entite));
        $this->queryBuilder->where('planning_id = :id');
        $this->queryBuilder->setParameter(':id', $entite->getId());

        $this->queryBuilder->execute();
    }

    /**
     * @inheritDoc
     */
    final protected function getEntite2Storage(AEntite $entite) : array
    {
        return [
            'name' => $entite->getName(),
            'status' => $entite->getStatus(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function deleteOne(AEntite $entite)
    {
        try {
            $this->_delete($entite->getId());
            $entite->reset();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function _delete(int $id) : int
    {
        $this->queryBuilder->delete($this->getTableName());
        $this->setWhere(['id' => $id]);
        $res = $this->queryBuilder->execute();

        return $res->rowCount();
    }

    /**
     * @inheritDoc
     */
    final protected function getTableName() : string
    {
        return 'planning';
    }
}
