<?php declare(strict_types = 1);
namespace LibertAPI\Groupe\Employe;

use LibertAPI\Tools\Libraries\AEntite;
use LibertAPI\Utilisateur\UtilisateurEntite;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.0
 *
 * Ne devrait être contacté que par EmployeRepository
 * Ne devrait contacter personne
 */
class EmployeDao extends \LibertAPI\Tools\Libraries\ADao
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
            $this->queryBuilder->andWhere('gu_gid = :id');
            $this->queryBuilder->setParameter(':id', (int) $parametres['id']);
        }
    }
}
