<?php declare(strict_types = 1);
namespace LibertAPI\Groupe\Responsable;

use LibertAPI\Tools\Libraries\AEntite;
use LibertAPI\Utilisateur\UtilisateurEntite;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.7
 *
 * Ne devrait être contacté que par ResponsableRepository
 * Ne devrait contacter personne
 */
class ResponsableDao extends \LibertAPI\Tools\Libraries\ADao
{
    /*************************************************
     * GET
     *************************************************/

    /*************************************************
     * POST
     *************************************************/

    /*************************************************
     * PUT
     *************************************************/


    /*************************************************
     * DELETE
     *************************************************/

    /**
     * Définit les filtres à appliquer à la requête
     *
     * @param array $parametres
     * @example [filter => []]
     */
    private function setWhere(array $parametres)
    {
        if (!empty($parametres['id'])) {
            $this->queryBuilder->andWhere('g_gid = :id');
            $this->queryBuilder->setParameter(':id', (int) $parametres['id']);
        }
    }
}
