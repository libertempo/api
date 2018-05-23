<?php declare(strict_types = 1);
namespace LibertAPI\Planning\Creneau;

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
 */
class CreneauRepository extends \LibertAPI\Tools\Libraries\ARepository
{
    /*************************************************
     * GET
     *************************************************/

    /**
     * @inheritDoc
     *
     * @param int $planningId Contrainte de recherche sur le planning
     */
    public function getOne(int $id, $planningId = -1) : AEntite
    {
        return $this->_getById($id, $planningId);
    }

    /**
     * @inheritDoc
     *
     * @param int $planningId Contrainte de recherche sur le planning
     */
    public function getById(int $id, $planningId = null) : AEntite
    {
        $this->queryBuilder->select('*');
        $this->setWhere(['id' => $id, 'planning_id' => $planningId]);
        $res = $this->queryBuilder->execute();

        $data = $res->fetch(\PDO::FETCH_ASSOC);
        if (empty($data)) {
            throw new \DomainException('#' . $id . ' is not a valid resource');
        }

        return new CreneauEntite($this->getStorage2Entite($data));
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
            $entite = new CreneauEntite($this->getStorage2Entite($value));
            $entites[$entite->getId()] = $entite;
        }

        return $entites;
    }

    /**
     * @inheritDoc
     */
    final protected function getParamsConsumer2Storage(array $paramsConsumer) : array
    {
        $results = [];
        if (!empty($paramsConsumer['planningId'])) {
            $results['planning_id'] = (int) $paramsConsumer['planningId'];
        }

        return $results;
    }

    /**
     * @inheritDoc
     */
    final protected function getStorage2Entite(array $dataStorage)
    {
        return [
            'id' => $dataStorage['creneau_id'],
            'planningId' => $dataStorage['planning_id'],
            'jourId' => $dataStorage['jour_id'],
            'typeSemaine' => $dataStorage['type_semaine'],
            'typePeriode' => $dataStorage['type_periode'],
            'debut' => $dataStorage['debut'],
            'fin' => $dataStorage['fin'],
        ];
    }

    /*************************************************
     * POST
     *************************************************/

    /**
     * Poste une liste de ressource
     *
     * @param array $data Tableau de données à poster
     * @param AEntite $entite [Vide par définition]
     *
     * @return array Tableau d'id des créneaux nouvellement créés
     * @throws MissingArgumentException Si un élément requis n'est pas présent
     * @throws \DomainException Si un élément de la ressource n'est pas dans le bon domaine de définition
     */
    public function postList(array $data, AEntite $entite) : array
    {
        $postIds = [];
        $this->beginTransaction();
        foreach ($data as $creneau) {
            try {
                $cloneEntite = clone $entite;
                $postIds[] = $this->postOne($creneau, $cloneEntite);
            } catch (\Exception $e) {
                $this->rollback();
                throw $e;
            }
        }
        $this->commit();

        return $postIds;
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
    final protected function getEntite2Storage(AEntite $entite) : array
    {
        return [
            'planning_id' => $entite->getPlanningId(),
            'jour_id' => $entite->getJourId(),
            'type_semaine' => $entite->getTypeSemaine(),
            'type_periode' => $entite->getTypePeriode(),
            'debut' => $entite->getDebut(),
            'fin' => $entite->getFin(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function _put(AEntite $entite)
    {
        $this->queryBuilder->update($this->getTableName());
        $this->queryBuilder->where('creneau_id = :id');
        $this->queryBuilder->setParameter(':id', $entite->getId());
        $this->setSet($this->getEntite2Storage($entite));

        $this->queryBuilder->execute();
    }

    /**
     * @inheritDoc
     */
    public function deleteOne(AEntite $entite)
    {
    }

    /**
     * @inheritDoc
     */
    public function _delete(int $id) : int
    {
        throw new \RuntimeException('Forbidden action');
    }

    /**
     * @inheritDoc
     */
    final protected function getTableName() : string
    {
        return 'planning_creneau';
    }
}
