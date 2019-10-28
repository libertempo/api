<?php
namespace LibertAPI\Configuration\Application;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entite
 *
 * @ORM\Table(name="conges_appli", indexes={@ORM\Index(name="appli_variable", columns={"appli_variable"})})
 * @ORM\Entity
 */
class Entite
{
    /**
     * @var int
     *
     * @ORM\Column(name="appli_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="appli_variable", type="string", length=100, nullable=false)
     */
    private $variable = '';

    /**
     * @var string
     *
     * @ORM\Column(name="appli_valeur", type="string", length=200, nullable=false)
     */
    private $valeur = '';


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
     * Set variable.
     *
     * @param string $variable
     *
     * @return Entite
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;

        return $this;
    }

    /**
     * Get variable.
     *
     * @return string
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * Set valeur.
     *
     * @param string $valeur
     *
     * @return Entite
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur.
     *
     * @return string
     */
    public function getValeur()
    {
        return $this->valeur;
    }
}
