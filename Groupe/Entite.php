<?php
namespace LibertAPI\Groupe;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entite
 *
 * @ORM\Table(name="conges_groupe")
 * @ORM\Entity
 * @todo à faire coller à l'entite précédente
 */
class Entite
{
    /**
     * @var int
     *
     * @ORM\Column(name="g_gid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="g_groupename", type="string", length=50, nullable=false)
     */
    private $name = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="g_comment", type="string", length=250, nullable=true)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="g_double_valid", type="string", length=0, nullable=false, options={"default"="N"})
     */
    private $doubleValid = 'N';


    /**
     * Unidirectional - Many employees are attached to many groups
     *
     * @ManyToMany(targetEntity="LibertAPI\Utilisateur\Entite")
     * @JoinTable(name="conges_groupe_users")
     */
    private $employesGroupe;


    public function __construct()
    {
        $this->employesGroupe = new ArrayCollection();
    }

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
     * Set name.
     *
     * @param string $name
     *
     * @return Entite
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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

    /**
     * Set doubleValid.
     *
     * @param string $doubleValid
     *
     * @return Entite
     */
    public function setDoubleValid($doubleValid)
    {
        $this->doubleValid = $doubleValid;

        return $this;
    }

    /**
     * Get doubleValid.
     *
     * @return string
     */
    public function getDoubleValid()
    {
        return $this->doubleValid;
    }

    public function getEmployesGroupe() : array
    {
        return $this->employesGroupe->toArray();
    }

    public function addEmployeGroupe(\LibertAPI\Utilisateur\Entite $employe) {
        $this->employesGroupe[] = $employe;
    }
}
