<?php declare(strict_types = 1);
namespace LibertAPI\Absence\Periode;

use LibertAPI\Tools\Libraries\AEntite;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.6
 * @see \Tests\Units\Absence\Periode\PeriodeRepository
 */
class PeriodeRepository extends \LibertAPI\Tools\Libraries\ARepository
{
    final protected function getEntiteClass() : string
    {
        return PeriodeEntite::class;
    }

    /**
     * {@inheritDoc}
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
            'id' => $dataStorage['p_login'],
            'login' => $dataStorage['p_login'],
            'date_deb' => $dataStorage['p_date_deb'],
            'demi_jour_deb' => $dataStorage['p_demi_jour_deb'],
            'date_fin' => $dataStorage['p_date_fin'],
            'demi_jour_fin' => $dataStorage['p_demi_jour_fin'],
            'nb_jours' => $dataStorage['p_nb_jours'],
            'commentaire' => $dataStorage['p_commentaire'],
            'type' => $dataStorage['p_type'],
            'etat' => $dataStorage['p_etat'],
            'edition_id' => $dataStorage['p_edition_id'],
            'motif_refus' => $dataStorage['p_motif_refus'],
            'date_demande' => $dataStorage['p_date_demande'],
            'date_traitement' => $dataStorage['p_date_traitement'],
            'fermeture_id' => $dataStorage['p_fermeture_id'],
            'num' => $dataStorage['p_num'],
        ];
    }

    /**
     * Définit les values à insérer
     *
     * @param array $values
     */
    final protected function setValues(array $values)
    {
    }

    final protected function setSet(array $parametres)
    {
    }

    /**
     * @inheritDoc
     */
    final protected function getEntite2Storage(AEntite $entite) : array
    {
        return [];
    }

    /**
     * Définit les filtres à appliquer à la requête
     *
     * @param array $parametres
     * @example [filter => []]
     */
    final protected function setWhere(array $parametres)
    {
        if (array_key_exists('id', $parametres)) {
            $this->queryBuilder->andWhere('login = :id');
            $this->queryBuilder->setParameter(':id', (int) $parametres['id']);
        }
    }

    /**
     * @inheritDoc
     */
    final protected function getTableName() : string
    {
        return 'conges_periode';
    }
}
