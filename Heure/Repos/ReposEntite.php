<?php declare(strict_types = 1);
namespace LibertAPI\Heure\Repos;

use LibertAPI\Tools\Exceptions\MissingArgumentException;

/**
 * @inheritDoc
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.8
 * @see \LibertAPI\Tests\Units\Heure\Repos\ReposEntite
 *
 * Ne devrait être contacté que par le ReposRepository
 * Ne devrait contacter personne
 */
class ReposEntite extends \LibertAPI\Tools\Libraries\AEntite
{
    /**
     * Retourne la donnée la plus à jour du champ name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getFreshData('name');
    }

    /**
     * Retourne la donnée la plus à jour du champ comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->getFreshData('comment');
    }

    /**
     * Retourne la donnée la plus à jour du champ de double validation
     *
     * @return bool
     */
    public function isDoubleValidated()
    {
        return (bool) $this->getFreshData('double_validation');
    }

    /**
     * @inheritDoc
     */
    public function populate(array $data)
    {
    }

    /**
     * Retourne la liste des champs requis
     *
     * @return array
     */
    private function getListRequired()
    {
        return [];
    }
}
