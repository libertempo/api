<?php declare(strict_types = 1);
namespace LibertAPI\JourFerie;

use LibertAPI\Tools\Libraries\AEntite;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.0
 *
 * Ne devrait être contacté que par JourFerieRepository
 * Ne devrait contacter personne
 */
class JourFerieDao extends \LibertAPI\Tools\Libraries\ADao
{
    /**
     * Définit les filtres à appliquer à la requête
     *
     * @param array $parametres
     * @example [filter => []]
     */
    private function setWhere(array $parametres)
    {
        unset($parametres);
    }
}
