<?php declare(strict_types = 1);
namespace LibertAPI\JourFerie;

use LibertAPI\Tools\Libraries\AEntite;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.0
 *
 * Ne devrait être contacté que par JourFerieRepository
 * Ne devrait contacter personne
 */
class JourFerieDao extends \LibertAPI\Tools\Libraries\ADao
{
    /*************************************************
     * GET
     *************************************************/

    /**
     * @inheritDoc
     */
    public function getById(int $id) : AEntite
    {
        throw new \RuntimeException('Action is forbidden');
    }

    /**
     * @inheritDoc
     */
    final protected function getStorage2Entite(array $dataDao)
    {
        return [
            'date' => $dataDao['jf_date'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function getList(array $parametres) : array
    {
        $this->queryBuilder->select('*');
        $this->setWhere($parametres);
        $res = $this->queryBuilder->execute();

        $data = $res->fetchAll(\PDO::FETCH_ASSOC);
        if (empty($data)) {
            throw new \UnexpectedValueException('No resource match with these parameters');
        }

        $entites = array_map(function ($value) {
                return new GroupeEntite($this->getStorage2Entite($value));
            },
            $data
        );

        return $entites;
    }

    /*************************************************
     * POST
     *************************************************/

    /**
     * @inheritDoc
     */
    public function post(AEntite $entite) : int
    {
        throw new \RuntimeException('Action is forbidden');
    }

    /*************************************************
     * PUT
     *************************************************/

    /**
     * @inheritDoc
     */
    public function put(AEntite $entite)
    {
        throw new \RuntimeException('Action is forbidden');
    }

    /**
     * @inheritDoc
     */
    final protected function getEntite2Storage(AEntite $entite) : array
    {
        return [
            'jf_date' => $entite->getDate(),
        ];
    }

    /*************************************************
     * DELETE
     *************************************************/

    /**
     * @inheritDoc
     */
    public function delete(int $id) : int
    {
        throw new \RuntimeException('Action is forbidden');
    }

    /**
     * Définit les filtres à appliquer à la requête
     *
     * @param array $parametres
     * @example [filter => []]
     */
    private function setWhere(array $parametres)
    {
        if (!empty($parametres['id'])) {
            $this->queryBuilder->andWhere('g_gid = :id');
            $this->queryBuilder->setParameter(':id', (int) $parametres['id']);
        }
    }

    /**
     * @inheritDoc
     */
    final protected function getTableName() : string
    {
        return 'conges_jours_feries';
    }
}
