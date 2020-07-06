<?php
namespace LibertAPI\Absence\Type;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entite
 *
 * @ORM\Table(name="conges_type_absence")
 * @ORM\Entity
 * @todo à faire coller à l'entite précédente
 */
class Entite
{
    /**
     * @var int
     *
     * @ORM\Column(name="ta_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ta_type", type="string", length=0, nullable=false, options={"default"="conges"})
     */
    private $type = 'conges';

    /**
     * @var string
     *
     * @ORM\Column(name="ta_libelle", type="string", length=20, nullable=false)
     */
    private $libelle = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ta_short_libelle", type="string", length=3, nullable=false, options={"fixed"=true})
     */
    private $shortLibelle = '';

    /**
     * @var bool
     *
     * @ORM\Column(name="type_natif", type="boolean", nullable=false)
     */
    private $typeNatif;

    /**
     * @var bool
     *
     * @ORM\Column(name="type_actif", type="boolean", nullable=false)
     */
    private $typeActif;

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
     * Set type.
     *
     * @param string $type
     *
     * @return Entite
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set libelle.
     *
     * @param string $libelle
     *
     * @return Entite
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle.
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set shortLibelle.
     *
     * @param string $shortLibelle
     *
     * @return Entite
     */
    public function setShortLibelle($shortLibelle)
    {
        $this->shortLibelle = $shortLibelle;

        return $this;
    }

    /**
     * Get shortLibelle.
     *
     * @return string
     */
    public function getShortLibelle()
    {
        return $this->shortLibelle;
    }

    /**
     * Set typeNatif.
     *
     * @param bool $typeNatif
     *
     * @return Entite
     */
    public function setTypeNatif(bool $typeNatif)
    {
        $this->typeNatif = $typeNatif;

        return $this;
    }

    /**
     * Get typeNatif.
     *
     * @return bool
     */
    public function isTypeNatif() : bool
    {
        return (bool) $this->typeNatif;
    }

    /**
     * Set typeActif.
     *
     * @param bool $typeActif
     *
     * @return Entite
     */
    public function setTypeActif(bool $typeActif)
    {
        $this->typeActif = $typeActif;

        return $this;
    }

    /**
     * Get typeActif.
     *
     * @return bool
     */
    public function isTypeActif() : bool
    {
        return (bool) $this->typeActif;
    }
}
