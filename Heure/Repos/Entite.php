<?php
namespace LibertAPI\Heure\Repos;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entite
 *
 * @ORM\Table(name="heure_repos")
 * @ORM\Entity
 */
class Entite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_heure", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idHeure;

    /**
     * @var binary
     *
     * @ORM\Column(name="login", type="binary", nullable=false)
     */
    private $login;

    /**
     * @var int
     *
     * @ORM\Column(name="debut", type="integer", nullable=false)
     */
    private $debut;

    /**
     * @var int
     *
     * @ORM\Column(name="fin", type="integer", nullable=false)
     */
    private $fin;

    /**
     * @var int
     *
     * @ORM\Column(name="duree", type="integer", nullable=false)
     */
    private $duree;

    /**
     * @var int
     *
     * @ORM\Column(name="type_periode", type="integer", nullable=false)
     */
    private $typePeriode;

    /**
     * @var int
     *
     * @ORM\Column(name="statut", type="integer", nullable=false)
     */
    private $statut = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=250, nullable=false)
     */
    private $comment = '';

    /**
     * @var string
     *
     * @ORM\Column(name="comment_refus", type="string", length=250, nullable=false)
     */
    private $commentRefus = '';


    /**
     * Get idHeure.
     *
     * @return int
     */
    public function getIdHeure()
    {
        return $this->idHeure;
    }

    /**
     * Set login.
     *
     * @param binary $login
     *
     * @return HeureRepos
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
     * Set debut.
     *
     * @param int $debut
     *
     * @return HeureRepos
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
     * @return HeureRepos
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

    /**
     * Set duree.
     *
     * @param int $duree
     *
     * @return HeureRepos
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree.
     *
     * @return int
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set typePeriode.
     *
     * @param int $typePeriode
     *
     * @return HeureRepos
     */
    public function setTypePeriode($typePeriode)
    {
        $this->typePeriode = $typePeriode;

        return $this;
    }

    /**
     * Get typePeriode.
     *
     * @return int
     */
    public function getTypePeriode()
    {
        return $this->typePeriode;
    }

    /**
     * Set statut.
     *
     * @param int $statut
     *
     * @return HeureRepos
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut.
     *
     * @return int
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set comment.
     *
     * @param string $comment
     *
     * @return HeureRepos
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set commentRefus.
     *
     * @param string $commentRefus
     *
     * @return HeureRepos
     */
    public function setCommentRefus($commentRefus)
    {
        $this->commentRefus = $commentRefus;

        return $this;
    }

    /**
     * Get commentRefus.
     *
     * @return string
     */
    public function getCommentRefus()
    {
        return $this->commentRefus;
    }
}
