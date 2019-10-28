<?php
namespace LibertAPI\Edition;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entite
 *
 * @ORM\Table(name="conges_solde_edition")
 * @ORM\Entity
 */
class Entite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="se_id_edition", type="integer", nullable=false)
     */
    private $idEdition;

    /**
     * @var int
     *
     * @ORM\Column(name="se_id_absence", type="integer", nullable=false)
     */
    private $idAbsence;

    /**
     * @var string
     *
     * @ORM\Column(name="se_solde", type="decimal", precision=4, scale=2, nullable=false)
     */
    private $solde;


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
     * Set idEdition.
     *
     * @param int $idEdition
     *
     * @return Entite
     */
    public function setIdEdition($idEdition)
    {
        $this->idEdition = $idEdition;

        return $this;
    }

    /**
     * Get idEdition.
     *
     * @return int
     */
    public function getIdEdition()
    {
        return $this->idEdition;
    }

    /**
     * Set idAbsence.
     *
     * @param int $idAbsence
     *
     * @return Entite
     */
    public function setIdAbsence($idAbsence)
    {
        $this->idAbsence = $idAbsence;

        return $this;
    }

    /**
     * Get idAbsence.
     *
     * @return int
     */
    public function getIdAbsence()
    {
        return $this->idAbsence;
    }

    /**
     * Set solde.
     *
     * @param string $solde
     *
     * @return Entite
     */
    public function setSolde($solde)
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * Get solde.
     *
     * @return string
     */
    public function getSolde()
    {
        return $this->solde;
    }
}
