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
 * Ne devrait contacter que le JourFerieEntite, JourFerieDao
 */
class JourFerieRepository extends \LibertAPI\Tools\Libraries\ARepository
{
    /*************************************************
     * GET
     *************************************************/

    /**
     * @inheritDoc
     */
    final protected function getParamsConsumer2Dao(array $paramsConsumer) : array
    {
        unset($paramsConsumer);
        return [];
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
            $this->dao->delete($entite->getId());
            $entite->reset();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
