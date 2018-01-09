<?php
namespace LibertAPI\Heure\HautResponsable\Repos;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina <wouldsmina@gmail.com>
 *
 * @since 0.6
 * @see \LibertAPI\Tests\Units\Heure\RH\ReposEntitie
 */

class ReposEntite extends \LibertAPI\Tools\Libraries\AEntite
{
    /**
     * Retourne la donnée la plus à jour du champ heure id
     *
     * @return int
     */
    public function getId()
    {
        return (int) $this->getFreshData('heureId');
    }

    /**
     * Retourne la donnée la plus à jour du champ employeId
     *
     * @return int
     */
    public function getEmployeId()
    {
        return $this->getFreshData('employeId');
    }

    /**
     * Retourne la donnée la plus à jour du champ debut
     *
     * @return int
     */
    public function getDebut()
    {
        return $this->getFreshData('debut');
    }

    /**
     * Retourne la donnée la plus à jour du champ fin
     *
     * @return int
     */
    public function getFin()
    {
        return $this->getFreshData('fin');
    }

    /**
     * Retourne la donnée la plus à jour du champ duree
     *
     * @return int
     */
    public function getDuree()
    {
        return $this->getFreshData('duree');
    }

    /**
     * Retourne la donnée la plus à jour du champ typePeriode
     *
     * @return int
     */
    public function getTypePeriode()
    {
        return $this->getFreshData('typePeriode');
    }

    /**
     * Retourne la donnée la plus à jour du champ statut
     *
     * @return int
     */
    public function getStatut()
    {
        return $this->getFreshData('statut');
    }

    /**
     * Retourne la donnée la plus à jour du champ commentaire
     *
     * @return int
     */
    public function getCommentaire()
    {
        return $this->getFreshData('commentaire');
    }

    /**
     * Retourne la donnée la plus à jour du champ commentaireRefus
     *
     * @return int
     */
    public function getcommentaireRefus()
    {
        return $this->getFreshData('commentaireRefus');
    }

    /**
     * @inheritDoc
     */
    public function populate(array $data)
    {
    }
}