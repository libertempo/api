<?php
namespace LibertAPI\Configuration\Configuration;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entite
 *
 * @ORM\Table(name="conges_config", indexes={@ORM\Index(name="conf_nom", columns={"conf_nom"})})
 * @ORM\Entity
 */
class Entite
{
    /**
     * @var int
     *
     * @ORM\Column(name="config_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="conf_nom", type="string", length=100, nullable=false)
     */
    private $nom = '';

    /**
     * @var string
     *
     * @ORM\Column(name="conf_valeur", type="string", length=200, nullable=false)
     */
    private $valeur = '';

    /**
     * @var string
     *
     * @ORM\Column(name="conf_groupe", type="string", length=200, nullable=false)
     */
    private $groupe = '';

    /**
     * @var string
     *
     * @ORM\Column(name="conf_type", type="string", length=200, nullable=false, options={"default"="texte"})
     */
    private $type = 'texte';

    /**
     * @var string
     *
     * @ORM\Column(name="conf_commentaire", type="text", length=65535, nullable=false)
     */
    private $commentaire;


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
     * Set confNom.
     *
     * @param string $confNom
     *
     * @return CongesConfig
     */
    public function setConfNom($confNom)
    {
        $this->confNom = $confNom;

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
     * Set valeur.
     *
     * @param string $valeur
     *
     * @return CongesConfig
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

    /**
     * Set groupe.
     *
     * @param string $groupe
     *
     * @return CongesConfig
     */
    public function setGroupe($groupe)
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * Get groupe.
     *
     * @return string
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return CongesConfig
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
     * Set commentaire.
     *
     * @param string $commentaire
     *
     * @return CongesConfig
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire.
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }
}
