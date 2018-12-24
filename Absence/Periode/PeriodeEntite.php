<?php declare(strict_types = 1);
namespace LibertAPI\Absence\Periode;

/**
 * @inheritDoc
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.1
 * @see \LibertAPI\Tests\Units\Absence\Periode\PeriodeEntite
 *
 * num
 */
class PeriodeEntite extends \LibertAPI\Tools\Libraries\AEntite
{
    /**
     * Retourne la donnée la plus à jour du champ login
     */
    public function getLogin() : string
    {
        return $this->getFreshData('login');
    }

    /**
     * Retourne la donnée la plus à jour du champ date début
     */
    public function getDateDebut() : string
    {
        return $this->getFreshData('date_deb');
    }

    /**
     * Retourne la donnée la plus à jour du champ demi journée debut
     */
    public function getDemiJourneeDebut() : string
    {
        return $this->getFreshData('demi_jour_deb');
    }

    /**
     * Retourne la donnée la plus à jour du champ date fin
     */
    public function getDateFin() : string
    {
        return $this->getFreshData('date_fin');
    }

    /**
     * Retourne la donnée la plus à jour du champ demi journée fin
     */
    public function getDemiJourneeFin() : string
    {
        return $this->getFreshData('demi_jour_fin');
    }

    /**
     * Retourne la donnée la plus à jour du champ nombre de jours
     */
    public function getNombreJours() : int
    {
        return (int) $this->getFreshData('nb_jours');
    }

    /**
     * Retourne la donnée la plus à jour du champ commentaire
     */
    public function getCommentaire() : string
    {
        return $this->getFreshData('commentaire');
    }

    /**
     * Retourne la donnée la plus à jour du champ type
     */
    public function getType() : string
    {
        return $this->getFreshData('type');
    }

    /**
     * Retourne la donnée la plus à jour du champ état
     */
    public function getEtat() : string
    {
        return $this->getFreshData('etat');
    }

    /**
     * Retourne la donnée la plus à jour du champ id d'édition
     */
    public function getEditionId() : string
    {
        return $this->getFreshData('edition_id');
    }

    /**
     * Retourne la donnée la plus à jour du champ motif de refus
     */
    public function getMotifRefus() : string
    {
        return $this->getFreshData('motif_refus');
    }

    /**
     * Retourne la donnée la plus à jour du champ date de demande
     */
    public function getDateDemande() : string
    {
        return $this->getFreshData('date_demande');
    }

    /**
     * Retourne la donnée la plus à jour du champ date traitement
     */
    public function getDateTraitement() : string
    {
        return $this->getFreshData('date_traitement');
    }

    /**
     * Retourne la donnée la plus à jour du champ id de fermeture
     */
    public function getFermetureId() : string
    {
        return $this->getFreshData('fermeture_id');
    }

    /**
     * Retourne la donnée la plus à jour du champ num
     */
    public function getNum() : string
    {
        return $this->getFreshData('num');
    }

    /**
     * @inheritDoc
     */
    public function populate(array $data)
    {
        $this->setLogin($data['login']);

        $erreurs = $this->getErreurs();
        if (!empty($erreurs)) {
            throw new \DomainException(json_encode($erreurs));
        }
    }

    /**
     * Tente l'insertion d'une donnée en tant que champ « login »
     *
     * Stocke une erreur si la donnée ne colle pas au domaine
     *
     * @todo
     */
    private function setLogin(string $login)
    {
        // domaine ?
        if (empty($login)) {
            $this->setErreur('login', 'Le champ est vide');
            return;
        }

        $this->dataUpdated['login'] = $login;
    }
}
