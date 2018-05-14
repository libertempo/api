<?php declare(strict_types = 1);
namespace LibertAPI\Groupe;

use LibertAPI\Tools\Exceptions\MissingArgumentException;

/**
 * @inheritDoc
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.7
 * @see \LibertAPI\Tests\Units\Groupe\GroupeEntite
 *
 * Ne devrait être contacté que par le GroupeDao
 * Ne devrait contacter personne
 */
class GroupeEntite extends \LibertAPI\Tools\Libraries\AEntite
{
    /**
     * Retourne la donnée la plus à jour du champ date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->getFreshData('date');
    }

    /**
     * @inheritDoc
     */
    public function populate(array $data)
    {
    }
}
