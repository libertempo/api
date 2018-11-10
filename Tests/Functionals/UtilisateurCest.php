<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

class UtilisateurCest extends BaseTestCest
{
    public function testListe(\ApiTester $i)
    {
        $i->sendGET('/utilisateur');

        $this->seeResponseOK($i);
    }

    public function testOneError(\ApiTester $i)
    {
        $i->sendGET('/utilisateur/hr');

        $i->seeResponseCodeIs(500);
    }
}
