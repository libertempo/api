<?php
namespace LibertAPI\Planning\Creneau;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entite
 *
 * @ORM\Table(name="planning_creneau", indexes={@ORM\Index(name="planning_id", columns={"planning_id", "type_semaine"})})
 * @ORM\Entity
 */
class Entite
{
    /**
     * @var int
     *
     * @ORM\Column(name="creneau_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $creneauId;

    /**
     * @var int
     *
     * @ORM\Column(name="planning_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $planningId;

    /**
     * @var bool
     *
<<<<<<< HEAD
     * @ORM\Column(name="jour_id", type="integer", nullable=false)
=======
     * @ORM\Column(name="jour_id", type="boolean", nullable=false)
>>>>>>> Added journal, creneau and planning entities
     */
    private $jourId;

    /**
     * @var bool
     *
<<<<<<< HEAD
     * @ORM\Column(name="type_semaine", type="integer", nullable=false)
=======
     * @ORM\Column(name="type_semaine", type="boolean", nullable=false)
>>>>>>> Added journal, creneau and planning entities
     */
    private $typeSemaine;

    /**
     * @var bool
     *
<<<<<<< HEAD
     * @ORM\Column(name="type_periode", type="integer", nullable=false)
=======
     * @ORM\Column(name="type_periode", type="boolean", nullable=false)
>>>>>>> Added journal, creneau and planning entities
     */
    private $typePeriode;

    /**
     * @var int
     *
     * @ORM\Column(name="debut", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $debut;

    /**
     * @var int
     *
     * @ORM\Column(name="fin", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $fin;

<<<<<<< HEAD

=======
>>>>>>> Added journal, creneau and planning entities
    /**
     * Get creneauId.
     *
     * @return int
     */
    public function getCreneauId()
    {
        return $this->creneauId;
    }

    /**
     * Set planningId.
     *
     * @param int $planningId
     *
     * @return PlanningCreneau
     */
    public function setPlanningId($planningId)
    {
        $this->planningId = $planningId;

        return $this;
    }

    /**
     * Get planningId.
     *
     * @return int
     */
    public function getPlanningId()
    {
        return $this->planningId;
    }

    /**
     * Set jourId.
     *
<<<<<<< HEAD
     * @param integer $jourId
=======
     * @param bool $jourId
>>>>>>> Added journal, creneau and planning entities
     *
     * @return PlanningCreneau
     */
    public function setJourId($jourId)
    {
        $this->jourId = $jourId;

        return $this;
    }

    /**
     * Get jourId.
     *
<<<<<<< HEAD
     * @return integer
=======
     * @return bool
>>>>>>> Added journal, creneau and planning entities
     */
    public function getJourId()
    {
        return $this->jourId;
    }

    /**
     * Set typeSemaine.
     *
<<<<<<< HEAD
     * @param integer $typeSemaine
=======
     * @param bool $typeSemaine
>>>>>>> Added journal, creneau and planning entities
     *
     * @return PlanningCreneau
     */
    public function setTypeSemaine($typeSemaine)
    {
        $this->typeSemaine = $typeSemaine;

        return $this;
    }

    /**
     * Get typeSemaine.
     *
<<<<<<< HEAD
     * @return integer
=======
     * @return bool
>>>>>>> Added journal, creneau and planning entities
     */
    public function getTypeSemaine()
    {
        return $this->typeSemaine;
    }

    /**
     * Set typePeriode.
     *
<<<<<<< HEAD
     * @param integer $typePeriode
=======
     * @param bool $typePeriode
>>>>>>> Added journal, creneau and planning entities
     *
     * @return PlanningCreneau
     */
    public function setTypePeriode($typePeriode)
    {
        $this->typePeriode = $typePeriode;

        return $this;
    }

    /**
     * Get typePeriode.
     *
<<<<<<< HEAD
     * @return integer
=======
     * @return bool
>>>>>>> Added journal, creneau and planning entities
     */
    public function getTypePeriode()
    {
        return $this->typePeriode;
    }

    /**
     * Set debut.
     *
     * @param int $debut
     *
     * @return PlanningCreneau
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut.
     *
     * @return int
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin.
     *
     * @param int $fin
     *
     * @return PlanningCreneau
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin.
     *
     * @return int
     */
    public function getFin()
    {
        return $this->fin;
    }
}
