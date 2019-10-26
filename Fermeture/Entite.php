<?php
namespace LibertAPI\Fermeture;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entite
 *
 * @ORM\Table(name="conges_jours_fermeture")
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
     * @ORM\Column(name="jf_id", type="integer", nullable=false)
     */
    private $fermetureId;

    /**
     * @var int
     *
     * @ORM\Column(name="jf_gid", type="integer", nullable=false)
     */
    private $groupeId = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="jf_date", type="date", nullable=false)
     */
    private $date;


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
     * Set fermetureId.
     *
     * @param int $fermetureId
     *
     * @return Entite
     */
    public function setFermetureId($fermetureId)
    {
        $this->fermetureId = $fermetureId;

        return $this;
    }

    /**
     * Get fermetureId.
     *
     * @return int
     */
    public function getFermetureId()
    {
        return $this->fermetureId;
    }

    /**
     * Set groupeId.
     *
     * @param int $groupeId
     *
     * @return Entite
     */
    public function setGroupeId($groupeId)
    {
        $this->groupeId = $groupeId;

        return $this;
    }

    /**
     * Get groupeId.
     *
     * @return int
     */
    public function getGroupeId()
    {
        return $this->groupeId;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Entite
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
