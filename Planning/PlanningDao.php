<?php declare(strict_types = 1);
namespace LibertAPI\Planning;

use LibertAPI\Tools\Libraries\AEntite;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.1
 *
 * Ne devrait être contacté que par PlanningRepository
 * Ne devrait contacter personne
 */
class PlanningDao extends \LibertAPI\Tools\Libraries\ADao
{
    /**
     * Définit les values à insérer
     *
     * @param array $values
     */
    private function setValues(array $values)
    {
        $this->queryBuilder->setValue('name', ':name');
        $this->queryBuilder->setParameter(':name', $values['name']);
        $this->queryBuilder->setValue('status', $values['status']);
    }

    /*************************************************
     * PUT
     *************************************************/


    private function setSet(array $parametres)
    {
        if (!empty($parametres['name'])) {
            $this->queryBuilder->set('name', ':name');
            $this->queryBuilder->setParameter(':name', $parametres['name']);
        }
        if (!empty($parametres['status'])) {
            $this->queryBuilder->set('status', ':status');
            $this->queryBuilder->setParameter(':status', $parametres['status']);
        }
    }

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
            $this->queryBuilder->andWhere('planning_id = :id');
            $this->queryBuilder->setParameter(':id', $parametres['id']);
        }
    }
}
