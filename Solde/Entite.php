<?php
namespace LibertAPI\Solde;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entite
 *
 * @ORM\Table(name="conges_solde_user")
 * @ORM\Entity
 */
class Entite
{
    /**
     * @var binary
     *
     * @ORM\Column(name="su_login", type="binary", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $login = '';

    /**
     * @var int
     *
     * @ORM\Column(name="su_abs_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $absId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="su_nb_an", type="decimal", precision=5, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $nbAn = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="su_solde", type="decimal", precision=5, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $solde = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="su_reliquat", type="decimal", precision=5, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $reliquat = '0.00';

    /**
     * Set login.
     *
     * @param binary $login
     *
     * @return CongesSoldeUser
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
     * Set absId.
     *
     * @param int $absId
     *
     * @return CongesSoldeUser
     */
    public function setAbsId($absId)
    {
        $this->absId = $absId;

        return $this;
    }

    /**
     * Get absId.
     *
     * @return int
     */
    public function getAbsId()
    {
        return $this->absId;
    }

    /**
     * Set nbAn.
     *
     * @param string $nbAn
     *
     * @return CongesSoldeUser
     */
    public function setNbAn($nbAn)
    {
        $this->nbAn = $nbAn;

        return $this;
    }

    /**
     * Get nbAn.
     *
     * @return string
     */
    public function getNbAn()
    {
        return $this->nbAn;
    }

    /**
     * Set solde.
     *
     * @param string $solde
     *
     * @return CongesSoldeUser
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

    /**
     * Set reliquat.
     *
     * @param string $reliquat
     *
     * @return CongesSoldeUser
     */
    public function setReliquat($reliquat)
    {
        $this->reliquat = $reliquat;

        return $this;
    }

    /**
     * Get reliquat.
     *
     * @return string
     */
    public function getReliquat()
    {
        return $this->reliquat;
    }
}
