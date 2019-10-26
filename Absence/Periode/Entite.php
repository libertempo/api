<?php
namespace LibertAPI\Absence\Periode;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entite
 *
 * @ORM\Table(name="conges_periode", indexes={@ORM\Index(name="p_num", columns={"p_num"})})
 * @ORM\Entity
 */
class Entite
{
    /**
     * @var int
     *
     * @ORM\Column(name="p_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var binary
     *
     * @ORM\Column(name="p_login", type="binary", nullable=false)
     */
    private $login = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="p_date_deb", type="date", nullable=false, options={"default"="0000-00-00"})
     */
    private $dateDeb = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="p_demi_jour_deb", type="string", length=0, nullable=false, options={"default"="am"})
     */
    private $demiJourDeb = 'am';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="p_date_fin", type="date", nullable=false, options={"default"="0000-00-00"})
     */
    private $dateFin = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="p_demi_jour_fin", type="string", length=0, nullable=false, options={"default"="pm"})
     */
    private $demiJourFin = 'pm';

    /**
     * @var string
     *
     * @ORM\Column(name="p_nb_jours", type="decimal", precision=5, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $nbJours = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="p_commentaire", type="string", length=250, nullable=true)
     */
    private $commentaire;

    /**
     * @var int
     *
     * @ORM\Column(name="p_type", type="integer", nullable=false, options={"default"="1","unsigned"=true})
     */
    private $type = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="p_etat", type="string", length=0, nullable=false, options={"default"="demande"})
     */
    private $etat = 'demande';

    /**
     * @var int|null
     *
     * @ORM\Column(name="p_edition_id", type="integer", nullable=true)
     */
    private $editionId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="p_motif_refus", type="string", length=250, nullable=true)
     */
    private $motifRefus;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="p_date_demande", type="datetime", nullable=true)
     */
    private $dateDemande;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="p_date_traitement", type="datetime", nullable=true)
     */
    private $dateTraitement;

    /**
     * @var int|null
     *
     * @ORM\Column(name="p_fermeture_id", type="integer", nullable=true)
     */
    private $fermetureId;

    /**
     * @var int
     *
     * @ORM\Column(name="p_num", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $pNum;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set login.
     *
     * @param binary $login
     *
     * @return Entite
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login.
     *
     * @return binary
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set dateDeb.
     *
     * @param \DateTime $dateDeb
     *
     * @return Entite
     */
    public function setDateDeb($dateDeb)
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    /**
     * Get dateDeb.
     *
     * @return \DateTime
     */
    public function getDateDeb()
    {
        return $this->dateDeb;
    }

    /**
     * Set demiJourDeb.
     *
     * @param string $demiJourDeb
     *
     * @return Entite
     */
    public function setDemiJourDeb($demiJourDeb)
    {
        $this->demiJourDeb = $demiJourDeb;

        return $this;
    }

    /**
     * Get demiJourDeb.
     *
     * @return string
     */
    public function getDemiJourDeb()
    {
        return $this->demiJourDeb;
    }

    /**
     * Set dateFin.
     *
     * @param \DateTime $dateFin
     *
     * @return Entite
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin.
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set demiJourFin.
     *
     * @param string $demiJourFin
     *
     * @return Entite
     */
    public function setDemiJourFin($demiJourFin)
    {
        $this->demiJourFin = $demiJourFin;

        return $this;
    }

    /**
     * Get demiJourFin.
     *
     * @return string
     */
    public function getDemiJourFin()
    {
        return $this->demiJourFin;
    }

    /**
     * Set nbJours.
     *
     * @param string $nbJours
     *
     * @return Entite
     */
    public function setNbJours($nbJours)
    {
        $this->nbJours = $nbJours;

        return $this;
    }

    /**
     * Get nbJours.
     *
     * @return string
     */
    public function getNbJours()
    {
        return $this->nbJours;
    }

    /**
     * Set commentaire.
     *
     * @param string|null $commentaire
     *
     * @return Entite
     */
    public function setCommentaire($commentaire = null)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire.
     *
     * @return string|null
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set type.
     *
     * @param int $type
     *
     * @return Entite
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set etat.
     *
     * @param string $etat
     *
     * @return Entite
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat.
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set editionId.
     *
     * @param int|null $editionId
     *
     * @return Entite
     */
    public function setEditionId($editionId = null)
    {
        $this->editionId = $editionId;

        return $this;
    }

    /**
     * Get editionId.
     *
     * @return int|null
     */
    public function getEditionId()
    {
        return $this->editionId;
    }

    /**
     * Set motifRefus.
     *
     * @param string|null $motifRefus
     *
     * @return Entite
     */
    public function setMotifRefus($motifRefus = null)
    {
        $this->motifRefus = $motifRefus;

        return $this;
    }

    /**
     * Get motifRefus.
     *
     * @return string|null
     */
    public function getMotifRefus()
    {
        return $this->motifRefus;
    }

    /**
     * Set dateDemande.
     *
     * @param \DateTime|null $dateDemande
     *
     * @return Entite
     */
    public function setDateDemande($dateDemande = null)
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    /**
     * Get dateDemande.
     *
     * @return \DateTime|null
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }

    /**
     * Set dateTraitement.
     *
     * @param \DateTime|null $dateTraitement
     *
     * @return Entite
     */
    public function setDateTraitement($dateTraitement = null)
    {
        $this->dateTraitement = $dateTraitement;

        return $this;
    }

    /**
     * Get dateTraitement.
     *
     * @return \DateTime|null
     */
    public function getDateTraitement()
    {
        return $this->dateTraitement;
    }

    /**
     * Set fermetureId.
     *
     * @param int|null $fermetureId
     *
     * @return Entite
     */
    public function setFermetureId($fermetureId = null)
    {
        $this->fermetureId = $fermetureId;

        return $this;
    }

    /**
     * Get fermetureId.
     *
     * @return int|null
     */
    public function getFermetureId()
    {
        return $this->fermetureId;
    }

    /**
     * Set num.
     *
     * @param int $num
     *
     * @return Entite
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get num.
     *
     * @return int
     */
    public function getNum()
    {
        return $this->num;
    }
}
