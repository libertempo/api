<?php
namespace LibertAPI\Utilisateur;

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
    public function getById($id)
    {
    }

    /**
     * @inheritDoc
     */
    public function getList(array $parametres)
    {
        $this->queryBuilder->select('*, u_login AS id');
        $this->setWhere($parametres);
        $res = $this->queryBuilder->execute();

        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    /*************************************************
     * POST
     *************************************************/

    public function post(array $a)
    {
    }

    /**
     * Met à jour une ressource
     *
     * @param array $data Données à mettre à jour
     * @param string $id Identifiant de l'élément (passer en int)
     */
    public function put(array $data, $id)
    {
        $this->queryBuilder->update($this->getTableName());
        $this->queryBuilder->setValue('token', $data['token']);
        $this->setWhere(['u_login' => $id]);

        $this->queryBuilder->execute();
    }

    /*************************************************
     * DELETE
     *************************************************/

    public function delete($id)
    {
    }

    /**
     * Définit les values à insérer
     *
     * @param array $parametres
     */
    private function setWhere(array $parametres)
    {
        if (!empty($parametres['u_login'])) {
            $this->queryBuilder->andWhere('u_login = :id');
            $this->queryBuilder->setParameter(':id', (int) $parametres['u_login']);
        }
        if (!empty($parametres['u_passwd'])) {
            $this->queryBuilder->andWhere('u_passwd = :passwor');
            $this->queryBuilder->setParameter(':passwor', (int) $parametres['u_passwd']);
        }
    }

    /**
     * @inheritDoc
     */
    final protected function getTableName()
    {
        return 'conges_users';
    }
}
