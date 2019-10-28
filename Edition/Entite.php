<?php
namespace LibertAPI\Edition;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entite
 *
 * @ORM\Table(name="conges_edition_papier")
 * @ORM\Entity
 */
class Entity
{
    /**
     * @var int
     *
     * @ORM\Column(name="ep_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var binary
     *
     * @ORM\Column(name="ep_login", type="binary", nullable=false)
     */
    private $login = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ep_date", type="date", nullable=false, options={"default"="0000-00-00"})
     */
    private $date = '0000-00-00';

    /**
     * @var int
     *
     * @ORM\Column(name="ep_num_for_user", type="integer", nullable=false, options={"default"="1","unsigned"=true})
     */
    private $numForUser = '1';

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

    /**
     * Set numForUser.
     *
     * @param int $numForUser
     *
     * @return Entite
     */
    public function setNumForUser($numForUser)
    {
        $this->numForUser = $numForUser;

        return $this;
    }

    /**
     * Get numForUser.
     *
     * @return int
     */
    public function getNumForUser()
    {
        return $this->numForUser;
    }
}
