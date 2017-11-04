<?php
namespace LibertAPI\Journal;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.5
 */
class JournalDao extends \LibertAPI\Tools\Libraries\ADao
{
    /*************************************************
     * GET
     *************************************************/

    /**
     * @inheritDoc
     */
    public function getById($id)
    {
        throw new \RuntimeException('Action is forbidden');
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
        throw new \RuntimeException('Action is forbidden');
    }

    /*************************************************
     * PUT
     *************************************************/

    /**
     * @inheritDoc
     */
    public function put(array $data, $id)
    {
        throw new \RuntimeException('Action is forbidden');
    }

    /*************************************************
     * DELETE
     *************************************************/

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        throw new \RuntimeException('Action is forbidden');
    }

    /**
     * Définit les filtres à appliquer à la requête
     *
     * @param array $parametres
     * @example [filter => [], lt => 23, limit => 4]
     */
    private function setWhere(array $parametres)
    {
        if (!empty($parametres['id'])) {
            $this->queryBuilder->andWhere('log_id = :id');
            $this->queryBuilder->setParameter(':id', (int) $parametres['id']);
        }
        if (!empty($parametres['lt'])) {
            $this->queryBuilder->andWhere('log_id < :lt');
            $this->queryBuilder->setParameter(':lt', (int) $parametres['lt']);
        }
        if (!empty($parametres['gt'])) {
            $this->queryBuilder->andWhere('log_id > :gt');
            $this->queryBuilder->setParameter(':gt', (int) $parametres['gt']);
        }
    }

    /**
     * @inheritDoc
     */
    final protected function getTableName()
    {
        return 'conges_logs';
    }
}
