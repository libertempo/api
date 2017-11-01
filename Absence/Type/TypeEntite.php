<?php
namespace LibertAPI\Absence\Type;

/**
 * @inheritDoc
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.5
 * @see \LibertAPI\Tests\Units\Absence\Type\TypeEntite
 */
class TypeEntite extends \LibertAPI\Tools\Libraries\AEntite
{
    /**
     * Retourne la donnée la plus à jour du champ type
     *
     * @return string
     */
    public function getType()
    {
        return $this->getFreshData('type');
    }

    /**
     * Retourne la donnée la plus à jour du champ libelle
     *
     * @return string
     * @TODO : changer le schema bd, le transtypage ne devrait pas être nécessaire
     */
    public function getLibelle()
    {
        return utf8_encode($this->getFreshData('libelle'));
    }

    /**
     * Retourne la donnée la plus à jour du champ libelle court
     *
     * @return string
     */
    public function getLibelleCourt()
    {
        return $this->getFreshData('libelleCourt');
    }

    /**
     * @inheritDoc
     */
    public function populate(array $data)
    {
        $this->setName($data['name']);
        $this->setStatus($data['status']);

        $erreurs = $this->getErreurs();
        if (!empty($erreurs)) {
            throw new \DomainException(json_encode($erreurs));
        }
    }

    /**
     * Tente l'insertion d'une donnée en tant que champ « name »
     *
     * Stocke une erreur si la donnée ne colle pas au domaine
     *
     * @param string $name
     * @todo
     */
    private function setName($name)
    {
        // domaine de name ?
        if (empty($name)) {
            $this->setErreur('name', 'Le champ est vide');
            return;
        }

        $this->dataUpdated['name'] = $name;
    }


    /**
     * Tente l'insertion d'une donnée en tant que champ « status »
     *
     * Stocke une erreur si la donnée ne colle pas au domaine
     *
     * @param string $status
     * @todo
     */
    private function setStatus($status)
    {
        // domaine de status ?
        if (empty($status)) {
            $this->setErreur('status', 'Le champ est vide');
            return;
        }

        $this->dataUpdated['status'] = $status;
    }
}
