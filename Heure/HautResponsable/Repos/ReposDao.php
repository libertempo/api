<?php
namespace LibertAPI\Heure\HautResponsable\Repos;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina <wouldsmina@gmail.com>
 *
 * @since 0.6
 *
 * Ne devrait être contacté que par Heure\HR\Repository
 * Ne devrait contacter personne
 */
class ReposDao extends \LibertAPI\Tools\Libraries\ADao
{
    /*************************************************
     * GET
     *************************************************/

    /**
     * @inheritDoc
     *
     * @param int $heureId Contrainte de recherche sur les heures
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

    /**
     * Définit les filtres à appliquer à la requête
     *
     * @param array $parametres
     */
    private function setWhere(array $parametres)
    {
        if (!empty($parametres['id'])) {
            $this->queryBuilder->andWhere('id_heure = :id');
            $this->queryBuilder->setParameter(':id', (int) $parametres['id']);
        }
        if (!empty($parametres['heure_statut'])) {
            $this->queryBuilder->andWhere('statut = :heure_statut');
            $this->queryBuilder->setParameter(':heure_statut', (int) $parametres['statut']);
        }
        if (!empty($parametres['lt'])) {
            $this->queryBuilder->andWhere('id_heure < :lt');
            $this->queryBuilder->setParameter(':lt', (int) $parametres['lt']);
        }
        if (!empty($parametres['gt'])) {
            $this->queryBuilder->andWhere('id_heure > :gt');
            $this->queryBuilder->setParameter(':gt', (int) $parametres['gt']);
        }
    }

    /**
     * Définit les values à insérer
     *
     * @param array $values
     */
    private function setValues(array $values)
    {
        $this->queryBuilder->setValue('login', ':login');
        $this->queryBuilder->setParameter(':login', $values['login']);
        $this->queryBuilder->setValue('debut', ':debut');
        $this->queryBuilder->setParameter(':debut', $values['debut']);
        $this->queryBuilder->setValue('fin', ':fin');
        $this->queryBuilder->setParameter(':fin', $values['fin']);
        $this->queryBuilder->setValue('duree', ':duree');
        $this->queryBuilder->setParameter(':duree', $values['duree']);
        $this->queryBuilder->setValue('type_periode', ':typePeriode');
        $this->queryBuilder->setParameter(':typePeriode', $values['typePeriode']);
        $this->queryBuilder->setValue('statut', ':statut');
        $this->queryBuilder->setParameter(':statut', $values['statut']);
        $this->queryBuilder->setValue('comment', ':commentaire');
        $this->queryBuilder->setParameter(':commentaire', $values['commentaire']);
        $this->queryBuilder->setValue('comment_refus', ':commentaireRefus');
        $this->queryBuilder->setParameter(':commentaireRefus', $values['commentaireRefus']);
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

    /*************************************************
     * PUT
     *************************************************/

    /**
     * @inheritDoc
     */
    public function put(array $data, $id)
    {
    }

    /*************************************************
     * DELETE
     *************************************************/

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
    }

    /**
     * @inheritDoc
     */
    final protected function getTableName()
    {
        return 'heure_repos';
    }
}