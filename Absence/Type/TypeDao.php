<?php
namespace LibertAPI\Absence\Type;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.5
 */
class TypeDao extends \LibertAPI\Tools\Libraries\ADao
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
        $this->queryBuilder->insert($this->getTableName());
        $this->setValues($data);
        $this->queryBuilder->execute();

        return $this->storageConnector->lastInsertId();
    }

    /**
     * Définit les values à insérer
     *
     * @param array $values
     */
    private function setValues(array $values)
    {
        $this->queryBuilder->setValue('ta_type', ':type');
        $this->queryBuilder->setParameter(':type', $values['type']);
        $this->queryBuilder->setValue('ta_libelle', ':libelle');
        $this->queryBuilder->setParameter(':libelle', $values['libelle']);
        $this->queryBuilder->setValue('ta_short_libelle', ':libelleCourt');
        $this->queryBuilder->setParameter(':libelleCourt', $values['libelleCourt']);
    }

    /*************************************************
     * PUT
     *************************************************/

    /**
     * @inheritDoc
     */
    public function put(array $data, $id)
    {
        $this->queryBuilder->update($this->getTableName());
        $this->setSet($data);
        $this->queryBuilder->where('ta_id = :id');
        $this->queryBuilder->setParameter(':id', $id);

        $this->queryBuilder->execute();
    }

    private function setSet(array $parametres)
    {
        if (!empty($parametres['type'])) {
            $this->queryBuilder->set('ta_type', ':type');
            $this->queryBuilder->setParameter(':type', $parametres['type']);
        }
        if (!empty($parametres['libelle'])) {
            $this->queryBuilder->set('ta_libelle', ':libelle');
            // @TODO : changer le schema
            $this->queryBuilder->setParameter(':libelle', $parametres['libelle']);
        }
        if (!empty($parametres['libelleCourt'])) {
            $this->queryBuilder->set('ta_short_libelle', ':libelleCourt');
            $this->queryBuilder->setParameter(':libelleCourt', $parametres['libelleCourt']);
        }
    }

    /*************************************************
     * DELETE
     *************************************************/

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        $this->queryBuilder->delete($this->getTableName());
        $this->setWhere(['ta_id' => $id]);
        $this->queryBuilder->execute();

        return $this->queryBuilder->rowCount();
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
            $this->queryBuilder->andWhere('ta_id = :id');
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
        return 'conges_type_absence';
    }
}
