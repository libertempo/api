<?php
namespace App\Components\Utilisateur;

use App\Libraries\AModel;
use App\Libraries\Application;
use App\Libraries\ARepository;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 * @see \Tests\Units\App\Components\Utilisateur\Repository
 *
 * Ne devrait être contacté que par le Authentification\Controller
 * Ne devrait contacter que le Utilisateur\Model, Utilisateur\Dao
 */
class Repository extends \App\Libraries\ARepository
{
    /**
     * @var Application Bibliothèque d'accès aux données de l'application
     */
    private $application;

    public function setApplication(Application $application)
    {
        if ($this->application instanceof Application) {
            throw new \LogicException('Application can\'t be set twice');
        }
        $this->application = $application;
    }

    /*************************************************
     * GET
     *************************************************/

    public function getOne($id)
    {
    }

    /**
     * Retourne une ressource correspondant à des critères
     *
     * @param array $parametres
     * @example [offset => 4, start-after => 23, filter => 'name::chapo|status::1,3']
     *
     * @return AModel
     */
    public function find(array $parametres)
    {
        $list = $this->getList($parametres);
        return reset($list);
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

        $models = [];
        foreach ($data as $value) {
            $model = new Model($this->getDataDao2Model($value));
            $models[$model->getId()] = $model;
        }

        return $models;
    }

    /**
     * @inheritDoc
     */
    final protected function getDataDao2Model(array $dataDao)
    {
        return $dataDao;
    }

    /**
     * @inheritDoc
     */
    final protected function getParamsConsumer2Dao(array $paramsConsumer)
    {
        // mise en hash du mdp pour verifier les schema dans consumer2Dao
        return $paramsConsumer;
    }

    /*************************************************
     * POST
     *************************************************/

    public function postOne(array $data, AModel $model)
    {
    }

    /*************************************************
     * PUT
     *************************************************/

    public function putOne(array $data, AModel $model)
    {
    }

    /**
     * Regénère le token de l'utilisateur pour une nouvelle session
     *
     * @param AModel $model Modèle utilisateur
     *
     * @return AModel Le modèle hydraté du nouveau token
     */
    public function regenerateToken(AModel $model)
    {
        $instanceToken = $this->application->getTokenInstance();
        if ('' === $instanceToken) {
            throw new \RuntimeException('Instance token is not set');
        }

        try {
            $model->populateToken($this->buildToken($instanceToken, $model));
            $dataDao = $this->getModel2DataDao($model);
            $this->dao->put($dataDao, $model->getId());

            return $model;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    final protected function getModel2DataDao(AModel $model)
    {
        return [
            'u_login' => $model->getLogin(),
            /*'u_nom' => $model->getJourId(),
            'u_prenom' => $model->getTypeSemaine(),
            'u_is_resp' => $model->getTypePeriode(),
            'u_is_admin' => $model->getDebut(),
            'u_is_hr' => $model->getFin(),
            'u_is_active' => $model->getFin(),
            'u_see_all' => $model->getFin(),
            'u_passwd' => $model->getFin(),
            'u_quotite' => $model->getFin(),
            'u_email' => $model->getFin(),
            'u_num_exercice' => $model->getFin(),
            'planning_id' => $model->getFin(),
            'u_heure_solde' => $model->getFin(),
            'date_inscription' => $model->getFin(),*/
            'token' => $model->getToken(),

        ];
    }

    /**
     *
     */
    private function buildToken($instanceToken, AModel $model)
    {
        // tokenUser = tokenInstance ^ (nomEmploye . ']#[ ' . dateInscriptionUtilisateur . ']#[' . idUtilisateur . ']#[' . dateJour)
    }

    /*************************************************
     * DELETE
     *************************************************/

    public function deleteOne(AModel $model)
    {
    }
}
