<?php declare(strict_types = 1);
namespace LibertAPI\Heure\Repos;

use LibertAPI\Tools\Libraries\AEntite;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.7
 * @see \LibertAPI\Tests\Units\Heure\Repos\ReposRepository
 *
 * Ne devrait être contacté que par le HeureReposUtilisateurController
 * Ne devrait contacter que le ReposEntite
 */
class ReposRepository extends \LibertAPI\Tools\Libraries\ARepository
{
    final protected function getEntiteClass() : string
    {
        return GroupeEntite::class;
    }

    /**
     * @inheritDoc
     */
    final protected function getParamsConsumer2Storage(array $paramsConsumer) : array
    {
        unset($paramsConsumer);
        return [];
    }

    /**
     * @inheritDoc
     */
    final protected function getStorage2Entite(array $dataStorage)
    {
        return [
            'id' => $dataStorage['g_gid'],
            'name' => $dataStorage['g_groupename'],
            'comment' => $dataStorage['g_comment'],
            'double_validation' => 'Y' === $dataStorage['g_double_valid']
        ];
    }

    /**
     * @inheritDoc
     */
    final protected function setValues(array $values)
    {
        $this->queryBuilder->setValue('g_groupename', ':name');
        $this->queryBuilder->setParameter(':name', $values['name']);
        $this->queryBuilder->setValue('g_comment', $values['comment']);
        $this->queryBuilder->setValue('g_double_valid', $values['double_validation']);
    }

    final protected function setSet(array $parametres)
    {
    }

    /**
     * @inheritDoc
     */
    final protected function setWhere(array $parametres)
    {
        if (array_key_exists('id', $parametres)) {
            $this->queryBuilder->andWhere('g_gid = :id');
            $this->queryBuilder->setParameter(':id', (int) $parametres['id']);
        }
    }

    /**
     * @inheritDoc
     */
    final protected function getEntite2Storage(AEntite $entite) : array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    final protected function getTableName() : string
    {
        return 'heure_repos';
    }

//     +---------------+------------------+------+-----+---------+----------------+
// | Field         | Type             | Null | Key | Default | Extra          |
// +---------------+------------------+------+-----+---------+----------------+
// | id_heure      | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
// | login         | varbinary(99)    | NO   |     | NULL    |                |
// | debut         | int(11)          | NO   |     | NULL    |                |
// | fin           | int(11)          | NO   |     | NULL    |                |
// | duree         | int(11)          | NO   |     | NULL    |                |
// | type_periode  | int(3)           | NO   |     | NULL    |                |
// | statut        | int(11)          | NO   |     | 0       |                |
// | comment       | varchar(250)     | NO   |     |         |                |
// | comment_refus | varchar(250)     | NO   |     |         |                |
// +---------------+------------------+------+-----+---------+----------------+

}
