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
 * @see \Tests\Units\Heure\HautResponsable\Repos
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
    public function getOne($id)
    {
        $id = (int) $id;
        $data = $this->dao->getById($id);
        if (empty($data)) {
            throw new \DomainException('Repos#' . $id . ' is not a valid resource');
        }

        return new ReposEntite($this->getDataDao2Entite($data));
    }

    /**
     * @inheritDoc
     */
    public function getList(array $parametres)
    {
        $data = $this->dao->getList($this->getParamsConsumer2Dao($parametres));
        if (empty($data)) {
            throw new \UnexpectedValueException('No resource match with these parameters');
        }

        $entites = [];
        foreach ($data as $value) {
            $entite = new ReposEntite($this->getDataDao2Entite($value));
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
            'typePeriode' => $dataDao['type_periode'],
            'commentaire' => $dataDao['comment'],
            'commentaireRefus' => $dataDao['comment_refus'],
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
        return ['login', 'debut', 'fin'];
    }

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