<?php declare(strict_types = 1);
namespace LibertAPI\Heure\Repos;

use LibertAPI\Tools\Exceptions\MissingArgumentException;

/**
 * @inheritDoc
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.8
 * @see \LibertAPI\Tests\Units\Heure\Repos\ReposEntite
 *
 * Ne devrait être contacté que par le ReposRepository
 * Ne devrait contacter personne
 */
class ReposEntite extends \LibertAPI\Tools\Libraries\AEntite
{
    /**
     * Retourne la donnée la plus à jour du champ login
     */
    public function getLogin() : string
    {
        return $this->getFreshData('login');
    }

    /**
     * Retourne la donnée la plus à jour du champ debut
     */
    public function getDebut() : int
    {
        return $this->getFreshData('debut');
    }

    /**
     * Retourne la donnée la plus à jour du champ fin
     */
    public function getFin() : int
    {
        return $this->getFreshData('fin');
    }

    /**
     * Retourne la donnée la plus à jour du champ duree
     */
    public function getDuree() : int
    {
        return $this->getFreshData('duree');
    }

    /**
     * Retourne la donnée la plus à jour du champ type_periode
     */
    public function getTypePeriode() : int
    {
        return $this->getFreshData('type_periode');
    }

    /**
     * Retourne la donnée la plus à jour du champ statut
     */
    public function getStatut() : int
    {
        return $this->getFreshData('statut');
    }

    /**
     * Retourne la donnée la plus à jour du champ commentaire
     */
    public function getCommentaire() : string
    {
        return $this->getFreshData('commentaire');
    }

    /**
     * Retourne la donnée la plus à jour du champ commentaire_refus
     */
    public function getCommentaireRefus() : string
    {
        return $this->getFreshData('commentaire_refus');
    }

    /**
     * @inheritDoc
     */
    public function populate(array $data)
    {
    }
}
