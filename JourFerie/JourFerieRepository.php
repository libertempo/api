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
 * Ne devrait être contacté que par le JourFerieController
 * Ne devrait contacter que le JourFerieEntite
 */
class JourFerieRepository extends \LibertAPI\Tools\Libraries\ARepository
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
    final protected function getParamsConsumer2Storage(array $paramsConsumer) : array
    {
        unset($paramsConsumer);
        return [];
    }

    /**
     * @inheritDoc
     * @TODO : cette méthode le montre, JourFerie n'est pas une entité, mais un value object.
     * L'id n'est donc pas nécessaire, et l'arbo habituelle est remise en cause
     */
    final protected function getStorage2Entite(array $dataStorage)
    {
        return [
            'id' => uniqid(),
            'date' => $dataStorage['jf_date'],
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

        $entites = array_map(
            function ($value) {
                return new JourFerieEntite($this->getStorage2Entite($value));
            },
            $data
        );

        return $entites;
    }

    /**
     * @inheritDoc
     */
    public function _post(AEntite $entite) : int
    {
        throw new \RuntimeException('Action is forbidden');
    }

    /**
     * @inheritDoc
     */
    public function _put(AEntite $entite)
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
    public function deleteOne(AEntite $entite)
    {
        $this->_delete($entite->getId());
        $entite->reset();
    }

    /**
     * @inheritDoc
     */
    public function _delete(int $id) : int
    {
        throw new \RuntimeException('Action is forbidden');
    }

    /**
     * @inheritDoc
     */
    final protected function getTableName() : string
    {
        return 'conges_jours_feries';
    }
}
