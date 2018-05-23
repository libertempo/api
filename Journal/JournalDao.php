<?php declare(strict_types = 1);
namespace LibertAPI\Journal;

use LibertAPI\Tools\Libraries\AEntite;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.5
 */
class JournalDao extends \LibertAPI\Tools\Libraries\ADao
{
    /**
     * Définit les filtres à appliquer à la requête
     *
     * @param array $parametres
     * @example [filter => []]
     */
    private function setWhere(array $parametres)
    {
        if (!empty($parametres['id'])) {
            $this->queryBuilder->andWhere('log_id = :id');
            $this->queryBuilder->setParameter(':id', (int) $parametres['id']);
        }
    }
}
