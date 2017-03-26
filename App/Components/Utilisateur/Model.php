<?php
namespace App\Components\Utilisateur;

/**
 * @inheritDoc
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 * @see \Tests\Units\App\Components\Utilisateur\Model
 *
 * Ne devrait être contacté que par le Utilisateur\Repository
 * Ne devrait contacter personne
 */
class Model extends \App\Libraries\AModel
{
    public function getToken()
    {
        return $this->getFreshData('token');
    }

    public function getLogin()
    {
    }

    /**
     * @inheritDoc
     */
    public function populate(array $data)
    {
    }

    /**
     * @todo
     */
    public function populateToken($token)
    {
    }

    /**
     * @inheritDoc
     * @TODO Le modèle utilisateur n'a pas de clé primaire en int, donc on surcharge le parent. Mettre une PK en int !
     */
    final protected function setId($id)
    {
        $this->id = (string) $id;
    }
}
