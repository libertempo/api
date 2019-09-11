<?php declare(strict_types = 1);
namespace LibertAPI\Solde;

use LibertAPI\Tools\Libraries\AEntite;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina <wouldsmina@gmail.com>
 *
 * @since 1.9
 * @see \LibertAPI\Tests\Units\SoldeRepository
 *
 * Ne devrait être contacté que par le SoldeEmployeController
 * Ne devrait contacter que SoldeEntite
 */
class SoldeRepository extends \LibertAPI\Tools\Libraries\ARepository
{
    final protected function getEntiteClass() : string
    {
        return SoldeEntite::class;
    }

    /**
     * @inheritDoc
     */
    final protected function getParamsConsumer2Storage(array $paramsConsumer) : array
    {
        $results = [];
        if (array_key_exists('login', $paramsConsumer)) {
            $results['login'] = (string) $paramsConsumer['login'];
        }

        return $results;
    }

    /**
     * @inheritDoc
     */
    final protected function getStorage2Entite(array $dataStorage)
    {
        return [
            'id' => $dataStorage['su_login'],
            'login' => $dataStorage['su_login'],
            'type_absence' => (int) $dataStorage['su_abs_id'],
            'solde_annuel' => (int) $dataStorage['su_nb_an'],
            'solde' => $dataStorage['su_solde'],
            'reliquat' => $dataStorage['su_reliquat'],
        ];
    }

    /**
     * @inheritDoc
     */
    final protected function setValues(array $values)
    {
        unset($values);
    }

    final protected function setSet(array $parametres)
    {
        unset($parametres);
    }

    /**
     * @inheritDoc
     */
    final protected function setWhere(array $parametres)
    {
        if (array_key_exists('login', $parametres)) {
            $this->queryBuilder->andWhere('login = :login');
            $this->queryBuilder->setParameter(':login', $parametres['login']);
        }
    }

    /**
     * @inheritDoc
     */
    final protected function getEntite2Storage(AEntite $entite) : array
    {
        unset($entite);
        return [];
    }

    /**
     * @inheritDoc
     */
    final protected function getTableName() : string
    {
        return 'conges_solde_user';
    }
}