<?php
namespace App\Components\Utilisateur;

use App\Libraries\AModel;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 * @see \Tests\Units\App\Components\Utilisateur\Repository
 *
 * Ne devrait être contacté que par le Authentification\Controller
 * Ne devrait contacter que le Utilisateur\Model, Utilisateur\Dao
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
