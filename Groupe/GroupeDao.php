<?php declare(strict_types = 1);
namespace LibertAPI\Groupe;

use LibertAPI\Tools\Libraries\AEntite;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.7
 *
 * Ne devrait être contacté que par GroupeRepository
 * Ne devrait contacter personne
 */
class GroupeDao extends \LibertAPI\Tools\Libraries\ADao
{
    /**
     * Définit les values à insérer
     *
     * @param array $values
     */
    private function setValues(array $values)
    {
        $this->queryBuilder->setValue('g_groupename', ':name');
        $this->queryBuilder->setParameter(':name', $values['name']);
        $this->queryBuilder->setValue('g_comment', $values['comment']);
        $this->queryBuilder->setValue('g_double_valid', $values['double_validation']);

    }

    private function setSet(array $parametres)
    {
        if (!empty($parametres['name'])) {
            $this->queryBuilder->set('g_groupename', ':name');
            $this->queryBuilder->setParameter(':name', $parametres['name']);
        }
        if (!empty($parametres['comment'])) {
            $this->queryBuilder->set('g_comment', ':comment');
            $this->queryBuilder->setParameter(':comment', $parametres['comment']);
        }
        if (!empty($parametres['double_validation'])) {
            $this->queryBuilder->set('g_double_valid', ':double_validation');
            $this->queryBuilder->setParameter(':double_validation', $parametres['double_validation']);
        }
    }

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
