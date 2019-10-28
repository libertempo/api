<?php
namespace LibertAPI\Journal;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entite
 *
 * @ORM\Table(name="conges_logs")
 * @ORM\Entity
 */
class Entite
{
    /**
     * @var int
     *
     * @ORM\Column(name="log_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="log_p_num", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $pNum;

    /**
     * @var binary
     *
     * @ORM\Column(name="log_user_login_par", type="binary", nullable=false)
     */
    private $userLoginPar = '';

    /**
     * @var binary
     *
     * @ORM\Column(name="log_user_login_pour", type="binary", nullable=false)
     */
    private $userLoginPour = '';

    /**
     * @var string
     *
     * @ORM\Column(name="log_etat", type="string", length=16, nullable=false)
     */
    private $etat = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="log_comment", type="text", length=65535, nullable=true)
     */
    private $comment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="log_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $date = 'CURRENT_TIMESTAMP';

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
     * Set pNum.
     *
     * @param int $pNum
     *
     * @return CongesLogs
     */
    public function setPNum($pNum)
    {
        $this->pNum = $pNum;

        return $this;
    }

    /**
     * Get pNum.
     *
     * @return int
     */
    public function getPNum()
    {
        return $this->pNum;
    }

    /**
     * Set userLoginPar.
     *
     * @param binary $userLoginPar
     *
     * @return CongesLogs
     */
    public function setUserLoginPar($userLoginPar)
    {
        $this->userLoginPar = $userLoginPar;

        return $this;
    }

    /**
     * Get userLoginPar.
     *
     * @return binary
     */
    public function getUserLoginPar()
    {
        return $this->userLoginPar;
    }

    /**
     * Set userLoginPour.
     *
     * @param binary $userLoginPour
     *
     * @return CongesLogs
     */
    public function setUserLoginPour($userLoginPour)
    {
        $this->userLoginPour = $userLoginPour;

        return $this;
    }

    /**
     * Get userLoginPour.
     *
     * @return binary
     */
    public function getUserLoginPour()
    {
        return $this->userLoginPour;
    }

    /**
     * Set etat.
     *
     * @param string $etat
     *
     * @return CongesLogs
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
     * Set comment.
     *
     * @param string|null $comment
     *
     * @return CongesLogs
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

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return CongesLogs
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
