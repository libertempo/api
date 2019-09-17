<?php declare(strict_types = 1);
namespace LibertAPI\Solde;

use LibertAPI\Tools\Exceptions\MissingArgumentException;

/**
 * @inheritDoc
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina <wouldsmina@gmail.com>
 *
 * @since 1.9
 * @see \LibertAPI\Tests\Units\Solde\SoldeEntite
 *
 * Ne devrait être contacté que par SoldeRepository
 * Ne devrait contacter personne
 */
class SoldeEntite extends \LibertAPI\Tools\Libraries\AEntite
{
    /**
     * Retourne la donnée la plus à jour du champ id (==login)
     */
    final protected function setId($id)
    {
        $this->id = (string) $id;
    }

    /**
     * Retourne la donnée la plus à jour du champ login
     */
    public function getLogin() : string
    {
        return $this->getFreshData('login');
    }

    /**
     * Retourne la donnée la plus à jour du champ su_abs_id
     */
    public function getTypeAbsence() : int
    {
        return $this->getFreshData('type_absence');
    }

    /**
     * Retourne la donnée la plus à jour du champ su_nb_an
     */
    public function getSoldeAn() : float
    {
        return $this->getFreshData('solde_annuel');
    }

    /**
     * Retourne la donnée la plus à jour du champ su_solde
     */
    public function getSolde() : float
    {
        return $this->getFreshData('solde');
    }

    /**
     * Retourne la donnée la plus à jour du champ su_reliquat
     */
    public function getReliquat() : string
    {
        return $this->getFreshData('reliquat');
    }

    /**
     * @inheritDoc
     */
    public function populate(array $data)
    {
    }
}
