<?php
namespace LibertAPI\Solde;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entite
 *
 * @ORM\Table(name="conges_solde_user", indexes={@ORM\Index(name="login_abs", columns={"su_login", "su_abs_id"})})
 * @ORM\Entity
 */
class Entite
{
    /**
     * @var int
     *
     * @ORM\Column(name="su_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $suId;

    /**
     * @var binary
     *
     * @ORM\Column(name="su_login", type="binary", nullable=false)
     */
    private $login = '';

    /**
     * @var int
     *
     * @ORM\Column(name="su_abs_id", type="integer", nullable=false, options={"unsigned"=true})
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
     * Set absId.
     *
     * @param int $absId
     *
     * @return Entite
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
     * @return Entite
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

    /**
     * Set reliquat.
     *
     * @param string $reliquat
     *
     * @return Entite
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
