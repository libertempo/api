<?php
namespace LibertAPI\Heure\HautResponsable\Repos;

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
class ReposRepository extends \LibertAPI\Tools\Libraries\ARepository
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
        if (!empty($paramsConsumer['limit'])) {
            $results['limit'] = $filterInt($paramsConsumer['limit']);
        }
        if (!empty($paramsConsumer['start-after'])) {
            $results['lt'] = $filterInt($paramsConsumer['start-after']);

        }
        if (!empty($paramsConsumer['start-before'])) {
            $results['gt'] = $filterInt($paramsConsumer['start-before']);
        }
        if (!empty($paramsConsumer['statut'])) {
            $results['statut'] = $filterInt($paramsConsumer['statut']);
        }
        if (!empty($paramsConsumer['login'])) {
            $results['u_login'] = (string) $paramsConsumer['login'];
        }

        return $results;
    }

    /**
     * @inheritDoc
     */
    final protected function getEntite2DataDao(AEntite $entite)
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
     * {@inheritDoc}
     */
    protected function getListRequired()
    {
        return [
            'login', 
            'debut', 
            'fin', 
            'duree', 
            'typePeriode', 
            'statut', 
            'commentaire', 
            'commentaireRefus'
        ];
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
        try {
            $entite->reset();
            $this->dao->delete($entite->getId());
        } catch (\Exception $e) {
            throw $e;
        }
    }
}