<?php
namespace LibertAPI\Absence\Echange;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entite
 *
 * @ORM\Table(name="conges_echange_rtt", indexes={@ORM\Index(name="login_date", columns={"e_login", "e_date_jour"})})
 * @ORM\Entity
 */
class Entite
{
    /**
     * @var int
     *
     * @ORM\Column(name="e_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $eId;

    /**
     * @var binary
     *
     * @ORM\Column(name="e_login", type="binary", nullable=false)
     */
    private $login = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="e_date_jour", type="date", nullable=false, options={"default"="0000-00-00"})
     */
    private $dateJour = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="e_absence", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $absence = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="e_presence", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $presence = 'N';

    /**
     * @var string|null
     *
     * @ORM\Column(name="e_comment", type="string", length=255, nullable=true)
     */
    private $comment;


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
     * Set dateJour.
     *
     * @param \DateTime $dateJour
     *
     * @return Entite
     */
    public function setDateJour($dateJour)
    {
        $this->dateJour = $dateJour;

        return $this;
    }

    /**
     * Get dateJour.
     *
     * @return \DateTime
     */
    public function getDateJour()
    {
        return $this->dateJour;
    }

    /**
     * Set absence.
     *
     * @param string $absence
     *
     * @return Entite
     */
    public function setAbsence($absence)
    {
        $this->absence = $absence;

        return $this;
    }

    /**
     * Get absence.
     *
     * @return string
     */
    public function getAbsence()
    {
        return $this->absence;
    }

    /**
     * Set presence.
     *
     * @param string $presence
     *
     * @return Entite
     */
    public function setPresence($presence)
    {
        $this->presence = $presence;

        return $this;
    }

    /**
     * Get presence.
     *
     * @return string
     */
    public function getPresence()
    {
        return $this->presence;
    }

    /**
     * Set comment.
     *
     * @param string|null $comment
     *
     * @return Entite
     */
    public function setComment($comment = null)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment.
     *
     * @return string|null
     */
    public function getComment()
    {
        return $this->comment;
    }
}
