<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Absence\Periode;

/**
 * Classe de test de l'entité de période d'absence
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.1
 */
final class PeriodeEntite extends \LibertAPI\Tests\Units\Tools\Libraries\AEntite
{
    /**
     * @inheritDoc
     */
    public function testConstructWithId()
    {
        $login = 'Logan';
        $commentaire = 'Je ne suis pas gros !';

        $this->newTestedInstance(['id' => $login, 'login' => $login, 'commentaire' => $commentaire]);

        $this->string($this->testedInstance->getId())->isIdenticalTo($login);
        $this->string($this->testedInstance->getLogin())->isIdenticalTo($login);
        $this->string($this->testedInstance->getCommentaire())->isIdenticalTo($commentaire);
    }

    /**
     * @inheritDoc
     */
    public function testConstructWithoutId()
    {
        $this->newTestedInstance(['name' => 'name', 'status' => 'status']);

        $this->variable($this->testedInstance->getId())->isNull();
    }

    /**
     * Teste la méthode populate avec un mauvais domaine de définition
     */
    public function testPopulateBadDomain()
    {
        $this->newTestedInstance([]);
        $data = ['login' => ''];

        $this->exception(function () use ($data) {
            $this->testedInstance->populate($data);
        })->isInstanceOf('\DomainException');
    }

    /**
     * Teste la méthode populate avec ok
     */
    public function testPopulateOk()
    {
        $this->newTestedInstance([]);
        $data = ['login' => 'Logan'];

        $this->testedInstance->populate($data);

        $this->string($this->testedInstance->getLogin())->isIdenticalTo($data['login']);
    }

    /**
     * @inheritDoc
     */
    public function testReset()
    {
        $this->newTestedInstance(['id' => 3, 'name' => 'name', 'status' => 'status']);

        $this->assertReset($this->testedInstance);
    }
}
