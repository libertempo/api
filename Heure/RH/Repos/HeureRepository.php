<?php
namespace LibertAPI\Heure\RH\Repos;

use LibertAPI\Tools\Exceptions\MissingArgumentException;
use LibertAPI\Tools\Libraries\AEntite;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina <wouldsmina@gmail.com>
 *
 * @since 0.6
 * @see \Tests\Units\Heure\RH\Repos
 */
class HeureRepository extends \LibertAPI\Tools\Libraries\ARepository
{
    /*************************************************
     * GET
     *************************************************/

    /**
     * @inheritDoc
     *
     * @param int $planningId Contrainte de recherche sur le planning
     */
    public function getOne($id, $heureStatut = null)
    {
        $id = (int) $id;
        $data = $this->dao->getById($id, $heureStatut);
        if (empty($data)) {
            throw new \DomainException('Heure#' . $id . ' with status#' . $heureStatut . ' is not a valid resource');
        }

        return new CreneauEntite($this->getDataDao2Entite($data));
    }

    /**
     * @inheritDoc
     */
    public function getList(array $parametres)
    {
        /* retourner une collection pour avoir le total, hors limite forcée (utile pour la pagination) */
        $data = $this->dao->getList($this->getParamsConsumer2Dao($parametres));
        if (empty($data)) {
            throw new \UnexpectedValueException('No resource match with these parameters');
        }

        $entites = [];
        foreach ($data as $value) {
            $entite = new HeureEntite($this->getDataDao2Entite($value));
            $entites[$entite->getId()] = $entite;
        }

        return $entites;
    }

    /**
     * @inheritDoc
     */
    final protected function getDataDao2Entite(array $dataDao)
    {
        return [
            'id' => $dataDao['heure_id'],
            'employe' => $dataDao['login'],
            'debut' => $dataDao['debut'],
            'fin' => $dataDao['fin'],
            'duree' => $dataDao['duree'],
            'statut' => $dataDao['statut'],
            'typePeriode' => $dataDao['typePeriode'],
            'commentaire' => $dataDao['commentaire'],
            'commentaireRefus' => $dataDao['commentaire_refus'],
        ];
    }

    /**
     * @inheritDoc
     */
    final protected function getParamsConsumer2Dao(array $paramsConsumer)
    {
        $filterInt = function ($var) {
            return filter_var(
                $var,
                FILTER_VALIDATE_INT,
                ['options' => ['min_range' => 1]]
            );
        };
        $results = [];
        if (!empty($paramsConsumer['heureStatut'])) {
            $results['statut'] = $filterInt($paramsConsumer['heureStatut']);
        }

        return $results;
    }

    /*************************************************
     * POST
     *************************************************/

    /**
     * Poste une liste de ressource
     *
     * @param array $data Tableau de données à poster
     * @param AEntite $entite [Vide par définition]
     */
    public function postList(array $data, AEntite $entite)
    {
    }

    /**
     * @inheritDoc
     */
    public function postOne(array $data, AEntite $entite)
    {
    }

    /**
     * @inheritDoc
     */
    final protected function getEntite2DataDao(AEntite $entite)
    {
    }

    /*************************************************
     * PUT
     *************************************************/

    /**
     * @inheritDoc
     */
    public function putOne(array $data, AEntite $entite)
    {
    }

    /*************************************************
     * DELETE
     *************************************************/

    /**
     * @inheritDoc
     */
    public function deleteOne(AEntite $entite)
    {
    }
}