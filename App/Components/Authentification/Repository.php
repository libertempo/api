<?php
namespace App\Components\Authentification;

use App\Libraries\AModel;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 * @see \Tests\Units\App\Components\Authentification\Repository
 *
 * Ne devrait être contacté que par le Authentification\Controller
 * Ne devrait contacter que le Authentification\Model, Authentification\Dao
 */
class Repository extends \App\Libraries\ARepository
{
    /*************************************************
     * GET
     *************************************************/

    public function getOne($id)
    {
    }

    public function getList(array $parametres)
    {
    }

    /**
     *
     */
    public function find(array $parametres)
    {
        $results = $this->getList($parametres);
        if (1 < count($results)) {

        }

        return reset($results);
    }

    /*************************************************
     * POST
     *************************************************/

    public function postOne(array $data, AModel $model)
    {
    }

    /*************************************************
     * PUT
     *************************************************/

    public function putOne(array $data, AModel $model)
    {
    }

    /**
     *
     */
    public function regenerateToken(AModel $model)
    {
        // setToken
        // save to storage
        // error managing
        // return model
    }

    /*************************************************
     * DELETE
     *************************************************/

    public function deleteOne(AModel $model)
    {
    }
}
