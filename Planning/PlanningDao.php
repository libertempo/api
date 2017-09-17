<?php
namespace LibertAPI\Planning;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.1
 *
 * Ne devrait être contacté que par Planning\Repository
 * Ne devrait contacter personne
 */
class PlanningDao extends \LibertAPI\Tools\Libraries\ADao
{
    /*************************************************
     * GET
     *************************************************/

    /**
     * @inheritDoc
     */
    public function getById($id)
    {
        $this->queryBuilder->select('*');
        $this->setWhere(['id' => $id]);
        $res = $this->queryBuilder->execute();

        return $res->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @inheritDoc
     */
    public function getList(array $parametres)
    {
        $this->queryBuilder->select('*');
        $this->setWhere($parametres);
        if (!empty($parametres['limit'])) {
            $this->queryBuilder->setFirstResult(0);
            $this->queryBuilder->setMaxResults((int) $parametres['limit']);
        }
        $res = $this->queryBuilder->execute();

        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    /*************************************************
     * POST
     *************************************************/

    /**
     * @inheritDoc
     */
    public function post(array $data)
    {
        $this->queryBuilder->insert();
        $this->queryBuilder->setValue('name', $data['name']);
        $this->queryBuilder->setValue('status', $data['status']);
        $this->queryBuilder->execute();

        return $this->storageConnector->lastInsertId();
    }

    /*************************************************
     * PUT
     *************************************************/

    /**
     * @inheritDoc
     */
    public function put(array $data, $id)
    {
        $this->queryBuilder->update();
        $this->setWhere(['id' => $id]);
        $this->queryBuilder->setValue('name', $data['name']);
        $this->queryBuilder->setValue('status', $data['status']);

        $this->queryBuilder->execute();
    }

    /*************************************************
     * DELETE
     *************************************************/

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        $this->queryBuilder->delete();
        $this->setWhere(['id' => $id]);
        $res = $this->queryBuilder->execute();

        return $res->rowCount();
    }

    /**
     * Retourne le tableau des filtres à appliquer à la requête
     *
     * @param array $parametres
     * @example [filter => [], lt => 23, limit => 4]
     */
    private function setWhere(array $parametres)
    {
        if (!empty($parametres['id'])) {
            $this->queryBuilder->andWhere('planning_id = :id');
            $this->queryBuilder->setParameter(':id', (int) $parametres['id']);
        }
        if (!empty($parametres['lt'])) {
            $this->queryBuilder->andWhere('planning_id < :lt');
            $this->queryBuilder->setParameter(':lt', (int) $parametres['lt']);
        }
        if (!empty($parametres['gt'])) {
            $this->queryBuilder->andWhere('planning_id > :gt');
            $this->queryBuilder->setParameter(':gt', (int) $parametres['gt']);
        }
    }

    /**
     * @inheritDoc
     */
    final protected function getTableName()
    {
        return 'planning';
    }
}
