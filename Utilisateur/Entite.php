<?php
namespace LibertAPI\Utilisateur;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entite
 *
 * @ORM\Table(name="conges_users", indexes={@ORM\Index(name="token", columns={"token"}), @ORM\Index(name="u_login", columns={"u_login"}), @ORM\Index(name="planning_id", columns={"planning_id"})})
 * @ORM\Entity
 */
class Entite
{
    /**
     * @var int
     *
     * @ORM\Column(name="u_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var binary
     *
     * @ORM\Column(name="u_login", type="binary", nullable=false)
     */
    private $login = '';

    /**
     * @var string
     *
     * @ORM\Column(name="u_nom", type="string", length=30, nullable=false)
     */
    private $nom = '';

    /**
     * @var string
     *
     * @ORM\Column(name="u_prenom", type="string", length=30, nullable=false)
     */
    private $prenom = '';

    /**
     * @var string
     *
     * @ORM\Column(name="u_is_resp", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $isResp = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="u_is_admin", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $isAdmin = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="u_is_hr", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $isHr = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="u_is_active", type="string", length=0, nullable=false, options={"default"="Y"})
     */
    private $isActive = 'Y';

    /**
     * @var string
     *
     * @ORM\Column(name="u_passwd", type="string", length=64, nullable=false)
     */
    private $passwd = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="u_quotite", type="integer", nullable=true, options={"default"="100"})
     */
    private $quotite = '100';

    /**
     * @var string|null
     *
     * @ORM\Column(name="u_email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="u_num_exercice", type="integer", nullable=false)
     */
    private $numExercice = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="planning_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $planningId;

    /**
     * @var int
     *
     * @ORM\Column(name="u_heure_solde", type="integer", nullable=false)
     */
    private $heureSolde = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_inscription", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateInscription = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=100, nullable=false)
     */
    private $token = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_last_access", type="datetime", nullable=false)
     */
    private $dateLastAccess;


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
     * Set nom.
     *
     * @param string $nom
     *
     * @return Entite
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom.
     *
     * @param string $prenom
     *
     * @return Entite
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom.
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set isResp.
     *
     * @param string $isResp
     *
     * @return Entite
     */
    public function setIsResp($isResp)
    {
        $this->isResp = $isResp;

        return $this;
    }

    /**
     * Get isResp.
     *
     * @return string
     */
    public function getIsResp()
    {
        return $this->isResp;
    }

    /**
     * Set isAdmin.
     *
     * @param string $isAdmin
     *
     * @return Entite
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Get isAdmin.
     *
     * @return string
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set isHr.
     *
     * @param string $isHr
     *
     * @return Entite
     */
    public function setIsHr($isHr)
    {
        $this->isHr = $isHr;

        return $this;
    }

    /**
     * Get isHr.
     *
     * @return string
     */
    public function getIsHr()
    {
        return $this->isHr;
    }

    /**
     * Set isActive.
     *
     * @param string $isActive
     *
     * @return Entite
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive.
     *
     * @return string
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set passwd.
     *
     * @param string $passwd
     *
     * @return Entite
     */
    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;

        return $this;
    }

    /**
     * Get passwd.
     *
     * @return string
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Set quotite.
     *
     * @param int|null $quotite
     *
     * @return Entite
     */
    public function setQuotite($quotite = null)
    {
        $this->quotite = $quotite;

        return $this;
    }

    /**
     * Get quotite.
     *
     * @return int|null
     */
    public function getQuotite()
    {
        return $this->quotite;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return Entite
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set numExercice.
     *
     * @param int $numExercice
     *
     * @return Entite
     */
    public function setNumExercice($numExercice)
    {
        $this->numExercice = $numExercice;

        return $this;
    }

    /**
     * Get numExercice.
     *
     * @return int
     */
    public function getNumExercice()
    {
        return $this->numExercice;
    }

    /**
     * Set planningId.
     *
     * @param int $planningId
     *
     * @return Entite
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
     * Set heureSolde.
     *
     * @param int $heureSolde
     *
     * @return Entite
     */
    public function setHeureSolde($heureSolde)
    {
        $this->heureSolde = $heureSolde;

        return $this;
    }

    /**
     * Get heureSolde.
     *
     * @return int
     */
    public function getHeureSolde()
    {
        return $this->heureSolde;
    }

    /**
     * Set dateInscription.
     *
     * @param \DateTime $dateInscription
     *
     * @return Entite
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription.
     *
     * @return \DateTime
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set token.
     *
     * @param string $token
     *
     * @return Entite
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set dateLastAccess.
     *
     * @param \DateTime $dateLastAccess
     *
     * @return Entite
     */
    public function setDateLastAccess($dateLastAccess)
    {
        $this->dateLastAccess = $dateLastAccess;

        return $this;
    }

    /**
     * Get dateLastAccess.
     *
     * @return \DateTime
     */
    public function getDateLastAccess()
    {
        return $this->dateLastAccess;
    }
}
