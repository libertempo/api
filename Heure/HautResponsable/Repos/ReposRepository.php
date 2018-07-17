<?php declare(strict_types = 1);
namespace LibertAPI\Heure\HautResponsable\Repos;

use LibertAPI\Tools\Libraries\AEntite;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina <wouldsmina@gmail.com>
 *
 * @since 0.6
 * @see \Tests\Units\Heure\HautResponsable\Repos
 */
class ReposRepository extends \LibertAPI\Tools\Libraries\ARepository
{
    final protected function getEntiteClass() : string
    {
        return ReposEntite::class;
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
            'id' => $dataStorage['heure_id'],
            'employe' => $dataStorage['login'],
            'debut' => $dataStorage['debut'],
            'fin' => $dataStorage['fin'],
            'duree' => $dataStorage['duree'],
            'statut' => $dataStorage['statut'],
            'typePeriode' => $dataStorage['type_periode'],
            'commentaire' => $dataStorage['comment'],
            'commentaireRefus' => $dataStorage['comment_refus'],
        ];
    }

    /**
     * @inheritDoc
     */
    final protected function setValues(array $values)
    {
        $this->queryBuilder->setValue('login', ':employe');
        $this->queryBuilder->setParameter(':employe', $values['employe']);
        $this->queryBuilder->setValue('debut', ':debut');
        $this->queryBuilder->setParameter(':debut', $values['debut']);
        $this->queryBuilder->setValue('fin', ':fin');
        $this->queryBuilder->setParameter(':fin', $values['fin']);
        $this->queryBuilder->setValue('duree', ':duree');
        $this->queryBuilder->setParameter(':duree', $values['duree']);
        $this->queryBuilder->setValue('type_periode', ':typePeriode');
        $this->queryBuilder->setParameter(':typePeriode', $values['typePeriode']);
        $this->queryBuilder->setValue('statut', ':statut');
        $this->queryBuilder->setParameter(':statut', $values['statut']);
        $this->queryBuilder->setValue('comment', ':commentaire');
        $this->queryBuilder->setParameter(':commentaire', $values['commentaire']);
        $this->queryBuilder->setValue('comment_refus', ':commentaireRefus');
        $this->queryBuilder->setParameter(':commentaireRefus', $values['commentaireRefus']);
    }

    final protected function setSet(array $parametres)
    {
        if (!empty($parametres['employe'])) {
            $this->queryBuilder->set('login', ':employe');
            $this->queryBuilder->setParameter(':employe', $parametres['employe']);
        }
        if (!empty($parametres['debut'])) {
            $this->queryBuilder->set('debut', ':debut');
            // @TODO : changer le schema
            $this->queryBuilder->setParameter(':debut', $parametres['debut']);
        }
        if (!empty($parametres['fin'])) {
            $this->queryBuilder->set('fin', ':fin');
            $this->queryBuilder->setParameter(':fin', $parametres['fin']);
        }
        if (!empty($parametres['duree'])) {
            $this->queryBuilder->set('duree', ':duree');
            $this->queryBuilder->setParameter(':duree', $parametres['duree']);
        }
        if (!empty($parametres['typePeriode'])) {
            $this->queryBuilder->set('type_periode', ':typePeriode');
            $this->queryBuilder->setParameter(':typePeriode', $parametres['typePeriode']);
        }
        if (!empty($parametres['commentaire'])) {
            $this->queryBuilder->set('comment', ':commentaire');
            $this->queryBuilder->setParameter(':commentaire', $parametres['commentaire']);
        }
        if (!empty($parametres['commentaireRefus'])) {
            $this->queryBuilder->set('comment_refus', ':commentaireRefus');
            $this->queryBuilder->setParameter(':commentaireRefus', $parametres['commentaireRefus']);
        }
    }

    /**
     * @inheritDoc
     */
    final protected function getEntite2Storage(AEntite $entite) : array
    {
        return [
            'login' => $entite->getEmployeId(),
            'debut' => $entite->getDebut(),
            'fin' => $entite->getFin(),
            'duree' => $entite->getDuree(),
            'typePeriode' => $entite->getTypePeriode(),
            'statut' => $entite->getStatut(),
            'commentaire' => $entite->getCommentaire(),
            'commentaireRefus' => $entite->getCommentaireRefus(),
        ];
    }
    /**
     * Définit les filtres à appliquer à la requête
     *
     * @param array $parametres
     */
    final protected function setWhere(array $parametres)
    {
        if (!empty($parametres['id'])) {
            $this->queryBuilder->andWhere('id_heure = :id');
            $this->queryBuilder->setParameter(':id', (int) $parametres['id']);
        }
        if (!empty($parametres['lt'])) {
            $this->queryBuilder->andWhere('id_heure < :lt');
            $this->queryBuilder->setParameter(':lt', (int) $parametres['lt']);
        }
        if (!empty($parametres['gt'])) {
            $this->queryBuilder->andWhere('id_heure > :gt');
            $this->queryBuilder->setParameter(':gt', (int) $parametres['gt']);
        }
    }

    /**
     * @inheritDoc
     */
    final protected function getTableName() : string
    {
        return 'heure_repos';
    }
}