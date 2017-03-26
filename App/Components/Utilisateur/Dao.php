<?php
namespace App\Components\Utilisateur;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 *
 * Ne devrait être contacté que par Utilisateur\Repository
 * Ne devrait contacter personne
 */
class Dao extends \App\Libraries\ADao
{
    public function getById($id)
    {
    }

    public function getList(array $a)
    {
    }

    public function post(array $a)
    {
    }

    /**
     * @inheritDoc
     */
    public function put(array $data, $id)
    {
    }

    public function delete($id)
    {
    }

    public function getTableName()
    {
    }
}
