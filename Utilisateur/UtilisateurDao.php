<?php declare(strict_types = 1);
namespace LibertAPI\Utilisateur;

use LibertAPI\Tools\Libraries\AEntite;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 */
class UtilisateurDao extends \LibertAPI\Tools\Libraries\ADao
{
    /*************************************************
     * POST
     *************************************************/


    private function setSet(array $parametres)
    {
        if (!empty($parametres['token'])) {
            $this->queryBuilder->set('token', ':token');
            $this->queryBuilder->setParameter(':token', $parametres['token']);
        }
        if (!empty($parametres['date_last_access'])) {
            $this->queryBuilder->set('date_last_access', ':date_last_access');
            $this->queryBuilder->setParameter(':date_last_access', $parametres['date_last_access']);
        }
    }

    /*************************************************
     * DELETE
     *************************************************/

    /**
     * Définit les values à insérer
     *
     * @param array $parametres
     */
    private function setWhere(array $parametres)
    {
        $whereCriteria = [];
        if (!empty($parametres['u_login'])) {
            $this->queryBuilder->andWhere('u_login = :id');
            $whereCriteria[':id'] = $parametres['u_login'];
        }
        if (!empty($parametres['u_passwd'])) {
            // @TODO: on vise la compat' dans la migration de #12,
            // mais il faudra à terme enlever md5
            $this->queryBuilder->andWhere('u_passwd = :passwordMd5 OR u_passwd = :passwordBlow');
            $whereCriteria[':passwordMd5'] = md5($parametres['u_passwd']);
            $whereCriteria[':passwordBlow'] = password_hash($parametres['u_passwd'], PASSWORD_BCRYPT);
        }
        if (!empty($parametres['token'])) {
            $this->queryBuilder->andWhere('token = :token');
            $whereCriteria[':token'] = $parametres['token'];
        }
        if (!empty($parametres['gt_date_last_access'])) {
            $this->queryBuilder->andWhere('date_last_access >= :gt_date_last_access');
            $whereCriteria[':gt_date_last_access'] = $parametres['gt_date_last_access'];
        }
        if (!empty($parametres['is_active'])) {
            $this->queryBuilder->andWhere('u_is_active = :actif');
            $whereCriteria[':actif'] = ($parametres['is_active']) ? 'Y' : 'N';
        }
        if (!empty($whereCriteria)) {
            $this->queryBuilder->setParameters($whereCriteria);
        }
    }
}
