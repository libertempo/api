<?php
namespace App\Components\Authentification;

/**
 * @inheritDoc
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.1
 * @see \Tests\Units\App\Components\Authentification\Model
 *
 * Ne devrait être contacté que par le Authentification\Repository
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
