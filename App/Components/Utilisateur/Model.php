<?php
namespace App\Components\Utilisateur;

/**
 * @inheritDoc
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.1
 * @see \Tests\Units\App\Components\Utilisateur\Model
 *
 * Ne devrait être contacté que par le Utilisateur\Repository
 * Ne devrait contacter personne
 */
class Model extends \App\Libraries\AModel
{
    /**
     * @inheritDoc
     */
    public function populate(array $data)
    {
    }

    public function getToken()
    {
    }
}
