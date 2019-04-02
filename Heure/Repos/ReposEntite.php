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
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->getFreshData('login');
    }

    /**
     * Retourne la donnée la plus à jour du champ debut
     *
     * @return string
     */
    public function getDebut()
    {
        return $this->getFreshData('debut');
    }

    /**
     * Retourne la donnée la plus à jour du champ fin
     *
     * @return string
     */
    public function getFin()
    {
        return $this->getFreshData('fin');
    }

    /**
     * Retourne la donnée la plus à jour du champ duree
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->getFreshData('duree');
    }

    /**
     * Retourne la donnée la plus à jour du champ type_periode
     *
     * @return string
     */
    public function getTypePeriode()
    {
        return $this->getFreshData('type_periode');
    }

    /**
     * Retourne la donnée la plus à jour du champ statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->getFreshData('statut');
    }

    /**
     * Retourne la donnée la plus à jour du champ commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->getFreshData('commentaire');
    }

    /**
     * Retourne la donnée la plus à jour du champ commentaire_refus
     *
     * @return string
     */
    public function getCommentaireRefus()
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
