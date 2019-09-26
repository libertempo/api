<?php
namespace LibertAPI\Groupe;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entite
 *
 * @ORM\Table(name="conges_groupe")
 * @ORM\Entity
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
    private $gid;

    /**
     * @var string
     *
     * @ORM\Column(name="g_groupename", type="string", length=50, nullable=false)
     */
    private $groupeName = '';

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
     * Get gid.
     *
     * @return int
     */
    public function getGid()
    {
        return $this->gid;
    }

    /**
     * Set groupeName.
     *
     * @param string $groupeName
     *
     * @return CongesGroupe
     */
    public function setGroupename($groupeName)
    {
        $this->groupeName = $groupeName;

        return $this;
    }

    /**
     * Get groupeName.
     *
     * @return string
     */
    public function getGroupename()
    {
        return $this->groupeName;
    }

    /**
     * Set comment.
     *
     * @param string|null $comment
     *
     * @return CongesGroupe
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
     * @return CongesGroupe
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
}
