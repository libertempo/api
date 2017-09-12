<?php
namespace Tests\Units\App\Components\Utilisateur;

use \App\Components\Utilisateur\Entite as _Entite;

/**
 * Classe de test du modèle de l'utilisateur
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 */
final class Entite extends \Tests\Units\App\Libraries\AEntite
{
    /**
     * @inheritDoc
     */
    public function testConstructWithId()
    {
        $id = 'Balin';

        $entite = new _Entite(['id' => $id]);

        $this->string($entite->getId())->isIdenticalTo($id);
    }

    /**
     * @inheritDoc
     */
    public function testConstructWithoutId()
    {
        $entite = new _Entite(['token' => 'token']);

        $this->variable($entite->getId())->isNull();
    }

    /**
     * @since 0.3
     */
    public function testGetLogin()
    {
        $model = new _Model(['token' => 'token', 'login' => 'login']);

        $this->variable($model->getLogin())->isNull();
    }

    /**
     * @inheritDoc
     */
    public function testReset()
    {
        $entite = new _Entite(['id' => 'Balin', 'token' => 'token']);

        $this->assertReset($entite);
    }

    /**
     * Teste la méthode populateToken avec un mauvais domaine de définition
     */
    public function testPopulateTokenBadDomain()
    {
        $entite = new _Entite([]);
        $token = '';

        $this->exception(function () use ($entite, $token) {
            $entite->populateToken($token);
        })->isInstanceOf('\DomainException');
    }


    /**
     * Teste la méthode populateToken avec ok
     */
    public function testPopulateTokenOk()
    {
        $entite = new _Entite([]);
        $token = 'AZP3401GJE9#';

        $entite->populateToken($token);

        $this->string($entite->getToken())->isIdenticalTo($token);
    }

    public function testUpdateDateLastAccess()
    {
        $model = new _Model(['id' => 3, 'dateLastAccess' => "0"]);

        $this->string($model->getDateLastAccess())->isIdenticalTo("0");

        $model->updateDateLastAccess();

        $this->string($model->getDateLastAccess())->isIdenticalTo(date('Y-m-d H:i'));
    }
}
